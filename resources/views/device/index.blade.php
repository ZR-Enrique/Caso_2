@extends('layout')

@section('content')
<div class="container">
    <h1>Dispositivos añadidos</h1>
    <head>
    <!-- Otros links y estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

    <a href="{{ route('device.create') }}" class="btn btn-primary">+ Agregar dispositivo</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Número de Teléfono</th>
                <th>Estado</th>
                <th>QR</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
                <tr>
                    <td>
                        {{ $device->name }}
                        <br>
                        <small class="text-muted">{{ $device->created_at->diffForHumans() }}</small>
                    </td>
                    <td>{{ $device->phone_number }}</td>
                    <td>
                        <span class="badge {{ $device->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $device->status == 'active' ? 'active' : 'inactive' }}
                        </span>
                    </td>
                    <td>
                        {!! QrCode::size(50)->generate('Dispositivo: ' . $device->name . ' - ID: ' . $device->id) !!}
                    </td>
                    <td>
                        <!-- Botón para ver detalles del dispositivo -->
                        <a href="{{ route('device.show', $device->id) }}" class="btn btn-info">
                            <i class="fas fa-info-circle"></i>
                        </a>

                        <!-- Botón Editar -->
                        <a href="{{ route('device.edit', $device->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('device.destroy', $device->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>

                        <!-- Botón para encender/apagar el dispositivo -->
                        <form action="{{ route('device.toggleStatus', $device->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn {{ $device->status == 'active' ? 'btn-danger' : 'btn-success' }}">
                                <i class="fas fa-power-off"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
