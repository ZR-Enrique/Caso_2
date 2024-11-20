@extends('layout')

@section('title', isset($tag) ? 'Editar Etiqueta' : 'Crear Etiqueta')

@section('content')
    <div class="container mt-5">
        <h2>{{ isset($tag) ? 'Editar Etiqueta' : 'Crear Etiqueta' }}</h2>

        <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
            @csrf
            @if (isset($tag))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la Etiqueta</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $tag->name ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($tag) ? 'Actualizar' : 'Crear' }} Etiqueta</button>
        </form>
    </div>
@endsection
