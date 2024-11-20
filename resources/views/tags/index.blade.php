@extends('layout')

@section('title', 'Etiquetas')

@section('content')
    <div class="container mt-5">
        <h2>Etiquetas</h2>
        <a href="{{ route('tags.create') }}" class="btn btn-success mb-3">Crear Etiqueta</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
