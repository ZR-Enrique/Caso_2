<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Device;
use App\Models\Tag;
use App\Models\SentMessage; // Importar el modelo para los mensajes enviados
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // Para el registro de errores
use Illuminate\Support\Facades\Http; // Importar el cliente HTTP de Laravel

class CampaignController extends Controller
{
    // Mostrar todas las campañas
    public function index()
    {
        // Obtener todas las campañas con sus relaciones (dispositivo y contactos)
        $campaigns = Campaign::with('contacts', 'device')->get();
        return view('campaigns.index', compact('campaigns'));
    }

    // Mostrar el formulario para crear una nueva campaña
    public function create()
    {
        // Obtener los dispositivos activos y las etiquetas
        $devices = Device::where('status', 'active')->get(); 
        $tags = Tag::all(); 
        return view('campaigns.create', compact('devices', 'tags'));
    }

    // Guardar la campaña nueva
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'device_id' => 'required|exists:devices,id', // Verifica que el dispositivo exista
            'tags' => 'required|array', // Se requiere al menos una etiqueta
            'scheduled_time' => 'required|date_format:Y-m-d\TH:i', // Validación del tiempo programado en formato datetime-local
        ]);

        // Crear la campaña
        $campaign = Campaign::create([
            'name' => $request->name,
            'message' => $request->message,
            'device_id' => $request->device_id, // Asociar dispositivo activo
            'status' => 'scheduled', // Por defecto, la campaña se programa
            'scheduled_time' => Carbon::parse($request->scheduled_time),
        ]);

        // Obtener contactos según las etiquetas seleccionadas
        $contacts = Contact::whereHas('tags', function ($query) use ($request) {
            $query->whereIn('tags.id', $request->tags);  // Especificar el nombre completo de la columna con la tabla
        })->get();

        // Asociar los contactos a la campaña
        $campaign->contacts()->sync($contacts);

        return redirect()->route('campaigns.index')->with('success', 'Campaña creada exitosamente.');
    }

    // Mostrar los detalles de una campaña específica
    public function show($id)
    {
        // Obtener la campaña con sus contactos y dispositivo asociado
        $campaign = Campaign::with('contacts', 'device')->findOrFail($id);
        return view('campaigns.show', compact('campaign'));
    }

    // Editar una campaña existente
    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        $devices = Device::where('status', 'active')->get();
        $tags = Tag::all();

        return view('campaigns.edit', compact('campaign', 'devices', 'tags'));
    }

    // Actualizar una campaña existente
    public function update(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'device_id' => 'required|exists:devices,id',
            'tags' => 'required|array',
            'scheduled_time' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Obtener la campaña y actualizarla
        $campaign = Campaign::findOrFail($id);
        $campaign->update([
            'name' => $request->name,
            'message' => $request->message,
            'device_id' => $request->device_id,
            'scheduled_time' => Carbon::parse($request->scheduled_time),
        ]);

        // Obtener los contactos según las etiquetas seleccionadas
        $contacts = Contact::whereHas('tags', function ($query) use ($request) {
            $query->whereIn('tags.id', $request->tags);  // Especificar el nombre completo de la columna con la tabla
        })->get();

        // Actualizar los contactos asociados a la campaña
        $campaign->contacts()->sync($contacts);

        return redirect()->route('campaigns.index')->with('success', 'Campaña actualizada exitosamente.');
    }

    // Eliminar una campaña
    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return redirect()->route('campaigns.index')->with('success', 'Campaña eliminada exitosamente.');
    }

    // Enviar campaña utilizando la API QR de Buho.la (POST Method)
    public function sendMessage(Request $request, $campaignId)
    {
        // Validación de los datos entrantes (opcional)
        $request->validate([
            'custom_message' => 'nullable|string', // Permitir mensaje personalizado opcionalmente
        ]);

        // Obtener la campaña con los contactos y el dispositivo asociado
        $campaign = Campaign::with('contacts', 'device')->findOrFail($campaignId);

        // Verificar si el dispositivo está activo
        if ($campaign->device->status !== 'active') {
            return redirect()->route('campaigns.index')->with('error', 'El dispositivo asociado no está activo.');
        }

        // Obtener el mensaje personalizado o el de la campaña
        $message = $request->custom_message ?? $campaign->message;

        // Asegurarse de que haya contactos para enviar mensajes
        if ($campaign->contacts->isEmpty()) {
            return redirect()->route('campaigns.index')->with('error', 'No hay contactos asociados a la campaña.');
        }

        // Obtener el Token de la API QR y la URL desde el archivo .env
        $apiToken = env('QR_API_TOKEN');  // Debes definir tu token en el archivo .env
        $apiUrl = env('QR_API_URL') . '/api/message/send-text';  // Endpoint para enviar mensajes

        // Verificar que la URL y el token no estén vacíos
        if (empty($apiUrl) || empty($apiToken)) {
            Log::error('La URL o el token de la API no están configurados correctamente.');
            return redirect()->route('campaigns.index')->with('error', 'La URL o el token de la API no están configurados correctamente.');
        }

        // Enviar el mensaje a cada contacto utilizando la API QR
        foreach ($campaign->contacts as $contact) {
            try {
                // Realizar la solicitud POST a la API QR
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiToken,
                    'Content-Type' => 'application/json',
                ])->post($apiUrl, [
                    'number' => $contact->phone_number,  // Número del contacto en formato internacional, ej: +51987654321
                    'message' => $message,               // Mensaje de la campaña
                ]);

                // Verificar si la respuesta fue exitosa
                if ($response->successful()) {
                    // Registrar el mensaje enviado
                    SentMessage::create([
                        'contact_id' => $contact->id,
                        'campaign_id' => $campaign->id,
                        'status' => 'success',
                        'sent_at' => Carbon::now(),
                    ]);
                } else {
                    // Registrar error en el envío
                    Log::error("Error enviando mensaje a {$contact->phone_number}: " . $response->body());
                    SentMessage::create([
                        'contact_id' => $contact->id,
                        'campaign_id' => $campaign->id,
                        'status' => 'failed',
                        'sent_at' => Carbon::now(),
                    ]);
                }
            } catch (\Exception $e) {
                // Si hay un error, lo registramos como fallido
                Log::error("Error enviando mensaje a {$contact->phone_number}: " . $e->getMessage());
                SentMessage::create([
                    'contact_id' => $contact->id,
                    'campaign_id' => $campaign->id,
                    'status' => 'failed',
                    'sent_at' => Carbon::now(),
                ]);
            }
        }

        // Retornar a la vista de campañas
        return redirect()->route('campaigns.index')->with('success', 'Mensajes enviados exitosamente.');
    }
}
