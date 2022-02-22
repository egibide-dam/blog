{{-- resources/views/entradas/comentarios.blade.php --}}

@extends('layouts.app')

@section('content')

    <h1 class="mt-3">{{ $entrada->titulo }}</h1>

    <table class="table table-striped">
        <tbody class="align-middle">
        <tr>
            <th>Texto</th>
            <td>{{ $entrada->texto }}</td>
        </tr>
        <tr>
            <th>Fecha</th>
            <td>{{ $entrada->fecha }}</td>
        </tr>
        <tr>
            <th>Visible</th>
            <td>{{ $entrada->visible ? 'Sí' : 'No' }}</td>
        </tr>
        </tbody>
    </table>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Email</th>
            <th>Fecha</th>
            <th>Texto</th>
        </tr>
        </thead>
        <tbody class="align-middle">
        @foreach($entrada->comentarios as $comentario)
            <tr>
                <td>{{ $comentario->email }}</td>
                <td>{{ $comentario->fecha }}</td>
                <td>{{ $comentario->texto }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>

    <h2>Deja tu comentario</h2>

    <form action="{{ route('comentarios.store') }}" method="POST">
        @csrf
        <input type="hidden" name="entrada_id" value="{{ $entrada->id }}"/>
        <div class="row mb-3">
            <label class="col-2 form-label">Título: </label>
            <div class="col-10">
                <input class="form-control" type="text" name="email"/>
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label">Texto: </label>
            <div class="col-10">
                <textarea class="form-control" name="texto"></textarea>
            </div>
        </div>
        <input class="btn btn-primary" type="submit" name="guardar" value="Guardar"/>
        <a class="link-secondary ms-2" href="{{ route('comentarios.index') }}">Cancelar</a>
    </form>

    <a class="btn btn-secondary mt-3" href="{{ route('entradas.index') }}">Volver</a>

@endsection
