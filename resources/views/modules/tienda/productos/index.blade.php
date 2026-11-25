@extends('appTienda')

@section('tittle', 'Mis productos')

@section('titulo', 'Mis productos')

@section('subtitulo', 'Registra, edita y activa o desactiva tus productos')

@section('contenido')
    @include('layouts.alertas')

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Listado de productos</h4>
            <a href="{{ route('tienda.productos.create') }}" class="btn btn-primary btn-round ms-auto">
                <i class="fa fa-plus"></i> Nuevo producto
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-productos" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Categorías</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>
                                    <img src="{{ asset('uploads/' . $producto->imagen) }}"
                                        alt="{{ $producto->nombre }}" width="60" class="rounded">
                                </td>
                                <td>{{ $producto->nombre }}</td>
                                <td>₡{{ number_format($producto->precio, 2) }}</td>
                                <td>
                                    @foreach ($producto->categorias as $categoria)
                                        <span class="badge badge-info">{{ $categoria->nombre }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($producto->activo)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('tienda.productos.edit', $producto) }}"
                                        class="btn btn-sm btn-primary">Editar</a>

                                    <form action="{{ route('tienda.productos.estado', $producto) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm {{ $producto->activo ? 'btn-warning' : 'btn-success' }}">
                                            {{ $producto->activo ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#tabla-productos').DataTable({
                order: [],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5]
                }],
                language: {
                    search: 'Buscar:',
                    lengthMenu: 'Mostrar _MENU_ productos',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ productos',
                    emptyTable: 'Todavía no has registrado productos',
                    zeroRecords: 'No se encontraron productos',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente'
                    }
                }
            });
        });
    </script>
@endsection