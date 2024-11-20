@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Dispositivo Conectado</h2>
                <div class="btn-group">
                    <!-- Botón para cambiar el estado del dispositivo -->
                    <form action="{{ route('device.toggleStatus', $device->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @if ($device->status == 'active')
                            <button type="submit" class="btn btn-danger me-2">Desconectar número</button>
                        @else
                            <button type="submit" class="btn btn-success me-2">Activar dispositivo</button>
                        @endif
                    </form>

                    <!-- Botón para reiniciar -->
                    <form action="{{ route('device.restart', $device->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Reiniciar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del dispositivo -->
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-3">
                <!-- Imagen del dispositivo -->
                @if($device->image_url)
                    <img src="{{ Storage::url($device->image_url) }}" alt="Imagen del dispositivo" class="img-fluid rounded-circle p-3">
                @else
                    <img src="https://via.placeholder.com/150" alt="Imagen del dispositivo" class="img-fluid rounded-circle p-3">
                @endif
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ $device->name }}
                        <span class="badge {{ $device->status == 'active' ? 'bg-primary' : 'bg-secondary' }}">
                            {{ $device->status == 'active' ? 'Conectado' : 'Desconectado' }}
                        </span>
                    </h4>
                    <p class="card-text"><strong>Número:</strong> {{ $device->phone_number }}</p>
                    <span class="badge {{ $device->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ $device->status == 'active' ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación entre detalles -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">Detalles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">API Key</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Aplicaciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ajustes</a>
        </li>
    </ul>

    <!-- Sección de detalles del perfil -->
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between">
            Profile Details
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Full Name</dt>
                <dd class="col-sm-9">Max Smith</dd>

                <dt class="col-sm-3">Company</dt>
                <dd class="col-sm-9">Keenthemes</dd>

                <dt class="col-sm-3">Contact Phone</dt>
                <dd class="col-sm-9">{{ $device->phone_number }} <span class="badge bg-success">Verified</span></dd>

                <dt class="col-sm-3">Country</dt>
                <dd class="col-sm-9">Germany</dd>

                <dt class="col-sm-3">Communication</dt>
                <dd class="col-sm-9">Email, Phone</dd>

                <dt class="col-sm-3">Allow Changes</dt>
                <dd class="col-sm-9">Yes</dd>
            </dl>
        </div>
    </div>

    <!-- Botón para volver a dispositivos -->
    <div class="mt-3">
        <a href="{{ route('device.index') }}" class="btn btn-outline-secondary">Volver a dispositivos</a>
    </div>
</div>
@endsection
