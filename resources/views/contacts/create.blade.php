@extends('layout')

@section('content')
<div class="container">
    <h1>Crear Contacto</h1>

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Número de Teléfono</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', '+51') }}" required>
        </div>

        <div class="form-group">
            <label for="tags">Etiquetas</label>
            <select multiple class="form-control" name="tags[]" id="tags">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <hr>

        <button type="submit" class="btn btn-success">Guardar Contacto</button>
    </form>
</div>
@endsection
