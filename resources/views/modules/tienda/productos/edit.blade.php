@extends('appTienda')

@section('tittle', 'Editar producto')

@section('titulo', 'Editar producto')

@section('subtitulo', $producto->nombre)

@section('contenido')
    @include('layouts.alertas')

    <form action="{{ route('tienda.productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos del producto</h4>
            </div>
            <div class="card-body">
                @include('modules.tienda.productos._form')

                @if ($producto->imagenes->count())
                    <div class="form-group">
                        <label>Galería actual (marca las que quieras quitar)</label>
                        <div class="row">
                            @foreach ($producto->imagenes as $img)
                                <div class="col-6 col-md-3 text-center mb-3">
                                    <img src="{{ asset('uploads/' . $img->imagen) }}" alt="Imagen de galería"
                                        class="img-fluid rounded mb-2">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" name="eliminar_imagenes[]"
                                            id="img{{ $img->id_imagen }}" value="{{ $img->id_imagen }}">
                                        <label class="form-check-label" for="img{{ $img->id_imagen }}">Quitar</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Guardar cambios</button>
                <a href="{{ route('tienda.productos.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
@endsection