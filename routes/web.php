<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome'); // Página de inicio
})->name('home');

// Rutas para campañas
Route::resource('campaigns', CampaignController::class);
Route::post('/campaigns/{campaign}/send', [CampaignController::class, 'sendMessage'])->name('campaigns.send');
Route::get('/campaigns/{id}/send', [CampaignController::class, 'send'])->name('campaigns.send');

// Rutas relacionadas con dispositivos
Route::prefix('devices')->group(function () {
    Route::get('/', [DeviceController::class, 'index'])->name('device.index'); // Listar dispositivos
    Route::get('/{id}', [DeviceController::class, 'show'])->name('device.show'); // Mostrar detalles del dispositivo
    Route::get('/{id}/edit', [DeviceController::class, 'editDetails'])->name('device.editDetails'); // Editar detalles del dispositivo
    Route::post('/{id}/disconnect', [DeviceController::class, 'disconnect'])->name('device.disconnect'); // Desconectar dispositivo
    Route::post('/{id}/restart', [DeviceController::class, 'restart'])->name('device.restart'); // Reiniciar dispositivo
    Route::post('/{id}/toggle-status', [DeviceController::class, 'toggleStatus'])->name('device.toggleStatus'); // Cambiar estado del dispositivo
});
Route::resource('device', DeviceController::class);

// Rutas relacionadas con las etiquetas (tags)
Route::resource('tags', TagController::class);

// Rutas relacionadas con los contactos
Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contacts.index'); // Listar contactos
    Route::get('/create', [ContactController::class, 'create'])->name('contacts.create'); // Crear contacto
    Route::post('/', [ContactController::class, 'store'])->name('contacts.store'); // Guardar contacto
    Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit'); // Editar contacto
    Route::put('/{contact}', [ContactController::class, 'update'])->name('contacts.update'); // Actualizar contacto
    Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy'); // Eliminar contacto
});
