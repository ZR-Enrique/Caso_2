@extends('layout')

@section('content')
<div class="container">
    <h1>Editar Dispositivo</h1>

    <form action="{{ route('device.update', $device->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre del Dispositivo</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $device->name) }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Número de Teléfono</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $device->phone_number) }}" required>
        </div>

        <!-- Input para cargar imagen -->
        <div class="form-group">
            <label for="image">Actualizar Imagen del Dispositivo</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Mostrar QR -->
        <div class="form-group">
            <h3>Código QR del dispositivo</h3>
            <img src="{{ Storage::url('qrcodes/device_' . $device->id . '.png') }}" alt="QR del dispositivo">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
