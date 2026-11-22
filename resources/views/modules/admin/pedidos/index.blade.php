@extends('appAdmin')

@section('tittle', 'Pedidos')

@section('titulo', 'Pedidos')

@section('subtitulo', 'Todos los pedidos registrados')

@section('contenido')
    @include('layouts.alertas')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Listado de pedidos</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-pedidos-admin" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Correo</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>#{{ $pedido->id_pedido }}</td>
                                <td>{{ $pedido->cliente }}</td>
                                <td>{{ $pedido->correo }}</td>
                                <td>₡{{ number_format($pedido->total, 2) }}</td>
                                <td>@include('layouts.estado', ['estado' => $pedido->estado])</td>
                                <td>
                                    <a href="{{ route('admin.pedidos.show', $pedido) }}" class="btn btn-sm btn-primary">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#tabla-pedidos-admin').DataTable({
                order: [],
                columnDefs: [{
                    orderable: false,
                    targets: [5]
                }],
                language: {
                    search: 'Buscar:',
                    lengthMenu: 'Mostrar _MENU_ pedidos',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ pedidos',
                    emptyTable: 'Todavía no hay pedidos registrados',
                    zeroRecords: 'No se encontraron pedidos',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente'
                    }
                }
            });
        });
    </script>
@endsection