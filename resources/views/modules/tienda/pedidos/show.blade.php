@extends('appTienda')

@section('tittle', 'Pedido #' . $pedido->id_pedido)

@section('titulo', 'Pedido #' . $pedido->id_pedido)

@section('subtitulo', 'Solo se muestran los productos de tu tienda')

@section('contenido')
    @include('layouts.alertas')

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Datos del pedido</h4>
            <span class="ms-auto">@include('layouts.estado', ['estado' => $pedido->estado])</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Fecha</strong>
                    <p>{{ $pedido->fecha?->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Cliente</strong>
                    <p>{{ $pedido->cliente }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Correo</strong>
                    <p>{{ $pedido->correo }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Teléfono</strong>
                    <p>{{ $pedido->telefono }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Mis productos en este pedido</h4>
        </div>
        <div class="card-body">
            @if ($pedido->estado === 'Entregado')
                <div class="alert alert-info">Este pedido ya fue entregado y no se puede modificar.</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->nombre_producto }}</td>
                                <td>₡{{ number_format($detalle->precio, 2) }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>₡{{ number_format($detalle->subtotal, 2) }}</td>
                                <td>@include('layouts.estado', ['estado' => $detalle->estado])</td>
                                <td>
                                    @if ($pedido->estado !== 'Entregado' && $detalle->estado !== 'Listo')
                                        <form action="{{ route('tienda.pedidos.listo', $detalle) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Marcar listo</button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Subtotal de mi tienda</th>
                            <th colspan="3">₡{{ number_format($detalles->sum('subtotal'), 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-action">
            <a href="{{ route('tienda.pedidos.index') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
@endsection