@extends('layout')

@section('content')
<div class="container">
    <h1>Editar Campaña</h1>

    <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $campaign->name }}" required>
        </div>

        <div class="form-group">
            <label for="message">Mensaje</label>
            <textarea name="message" class="form-control" required>{{ $campaign->message }}</textarea>
        </div>

        <div class="form-group">
            <label for="device_id">Dispositivo</label>
            <select name="device_id" class="form-control" required>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ $campaign->device_id == $device->id ? 'selected' : '' }}>
                        {{ $device->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="scheduled_time">Fecha Programada</label>
            <input type="datetime-local" name="scheduled_time" class="form-control" value="{{ \Carbon\Carbon::parse($campaign->scheduled_time)->format('Y-m-d\TH:i') }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
