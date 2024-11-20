@extends('layout')

@section('title', $contact->exists ? 'Editar Contacto' : 'Crear Contacto')

@section('content')
    <h1>{{ $contact->exists ? 'Editar Contacto' : 'Crear Contacto' }}</h1>

    <form action="{{ $contact->exists ? route('contacts.update', $contact) : route('contacts.store') }}" method="POST">
        @csrf
        @if ($contact->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $contact->name) }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Número de Teléfono</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $contact->phone_number) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}">
        </div>

        <div class="form-group">
            <label for="tags">Etiquetas</label>
            <select name="tags[]" class="form-control" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $contact->tags->contains($tag->id) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ $contact->exists ? 'Actualizar' : 'Crear' }}</button>
    </form>
@endsection
