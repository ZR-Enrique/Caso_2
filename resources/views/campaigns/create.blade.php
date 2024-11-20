@extends('layout')

@section('title', 'Crear Campaña')

@section('content')
    <div class="container">
        <h1>Crear Campaña</h1>
        <form action="{{ route('campaigns.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre de la Campaña</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa el nombre de la campaña" required>
            </div>

            <div class="form-group">
                <label for="message">Mensaje</label>
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Escribe el mensaje de la campaña" required></textarea>
            </div>

            <div class="form-group">
                <label for="device_id">Seleccionar Dispositivo</label>
                <select class="form-control" id="device_id" name="device_id" required>
                    <option value="">-- Selecciona un dispositivo --</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tags">Seleccionar Etiquetas</label>
                <select class="form-control" id="tags" name="tags[]" multiple required>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="scheduled_time">Fecha y Hora Programada</label>
                <input type="datetime-local" class="form-control" id="scheduled_time" name="scheduled_time" required>
            </div>

            <hr>

            <button type="submit" class="btn btn-success">Crear Campaña</button>
        </form>
    </div>
@endsection
