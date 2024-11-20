@extends('layout')

@section('title', 'Listado de Campañas')

@section('content')
<div class="container mt-5">
    <h1>Listado de Campañas</h1>

    <!-- Botón para crear una nueva campaña -->
    <div class="mb-3 text-right">
        <a href="{{ route('campaigns.create') }}" class="btn btn-success">
         
            <i class="fas fa-plus"></i> Crear Campaña
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Mensaje</th>
                <th>Dispositivo</th>
                <th>Hora Programada</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($campaigns as $campaign)
            <tr>
                <td>{{ $campaign->name }}</td>
                <td>{{ $campaign->message }}</td>
                <td>{{ $campaign->device->name ?? 'Dispositivo no disponible' }}</td>
                <td>{{ $campaign->scheduled_time }}</td>
                <td>{{ $campaign->status }}</td>
                <td>
                    <div class="d-flex">
                        <!-- Botón Enviar -->
                        <form action="{{ route('campaigns.send', $campaign->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm mr-2">
                                <i class="fas fa-paper-plane"></i> Enviar
                            </button>
                        </form>

                        <!-- Botón Editar -->
                        <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning btn-sm mr-2">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Estilos CSS adicionales -->
<link rel="stylesheet" href="{{ asset('css/campaigns.css') }}">
@endsection
