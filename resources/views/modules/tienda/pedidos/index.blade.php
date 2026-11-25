@extends('appTienda')

@section('tittle', 'Mis pedidos')

@section('titulo', 'Mis pedidos')

@section('subtitulo', 'Pedidos que incluyen productos de tu tienda')

@section('contenido')
    @include('layouts.alertas')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Listado de pedidos</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-pedidos" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Mi subtotal</th>
                            <th>Listos</th>
                            <th>Estado del pedido</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            @php
                                $misDetalles = $pedido->detalles;
                                $listos = $misDetalles->where('estado', 'Listo')->count();
                            @endphp
                            <tr>
                                <td>#{{ $pedido->id_pedido }}</td>
                                <td>{{ $pedido->fecha?->format('d/m/Y H:i') }}</td>
                                <td>{{ $pedido->cliente }}</td>
                                <td>{{ $misDetalles->count() }}</td>
                                <td>₡{{ number_format($misDetalles->sum('subtotal'), 2) }}</td>
                                <td>{{ $listos }} de {{ $misDetalles->count() }}</td>
                                <td>@include('layouts.estado', ['estado' => $pedido->estado])</td>
                                <td>
                                    <a href="{{ route('tienda.pedidos.show', $pedido) }}" class="btn btn-sm btn-primary">Ver</a>
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
            $('#tabla-pedidos').DataTable({
                order: [],
                columnDefs: [{
                    orderable: false,
                    targets: [7]
                }],
                language: {
                    search: 'Buscar:',
                    lengthMenu: 'Mostrar _MENU_ pedidos',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ pedidos',
                    emptyTable: 'Todavía no hay pedidos con productos de tu tienda',
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