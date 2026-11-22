@extends('appTienda')

@section('tittle', 'Nuevo producto')

@section('titulo', 'Nuevo producto')

@section('subtitulo', 'Registra un producto en tu tienda')

@section('contenido')
    @include('layouts.alertas')

    <form action="{{ route('tienda.productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos del producto</h4>
            </div>
            <div class="card-body">
                @include('modules.tienda.productos._form')
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('tienda.productos.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
@endsection