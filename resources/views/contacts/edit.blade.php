@extends('layout')

@section('content')
<div class="container">
    <h1>Editar Contacto</h1>

    <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $contact->name) }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Número de Teléfono</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $contact->phone_number) }}" required>
        </div>

        <!-- Dropdown con checkbox para las etiquetas -->
        <div class="form-group">
            <label for="tags">Etiquetas</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownTags" data-bs-toggle="dropdown" aria-expanded="false">
                    Seleccionar Etiquetas
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownTags">
                    @foreach($tags as $tag)
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}"
                                    {{ in_array($tag->id, $contact->tags->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tag{{ $tag->id }}">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Agregar nueva etiqueta</a></li> <!-- Opcional -->
                </ul>
            </div>
        </div>
        <br>
        <hr>

        <button type="submit" class="btn btn-success">Actualizar Contacto</button>
    </form>
</div>
@endsection
