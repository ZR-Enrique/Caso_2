@extends('layout')

@section('content')
<div class="container">
    <h1>Añadir Dispositivo</h1>

    <form action="{{ route('device.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Paso 1: Nombre del dispositivo -->
        <div class="form-group">
            <label for="name">Nombre del dispositivo</label>
            <input type="text" name="name" id="app-name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Número de Teléfono</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>

        <!-- Input para cargar imagen -->
        <div class="form-group">
            <label for="image">Imagen del Dispositivo (opcional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
