@extends('appAdmin')

@section('tittle', 'Pedido #' . $pedido->id_pedido)

@section('titulo', 'Pedido #' . $pedido->id_pedido)

@section('subtitulo', 'Desglose completo del pedido')

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
            <h4 class="card-title">Productos del pedido</h4>
        </div>
        <div class="card-body">
            @if ($pedido->estado === 'Entregado')
                <div class="alert alert-info">Este pedido ya fue entregado y no se puede modificar.</div>
            @elseif ($pedido->estado !== 'Listo')
                <div class="alert alert-warning">Todavía hay productos en espera. La entrega solo se puede confirmar
                    cuando todos estén listos.</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Tienda</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->nombre_producto }}</td>
                                <td>{{ $detalle->nombre_tienda }}</td>
                                <td>₡{{ number_format($detalle->precio, 2) }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>₡{{ number_format($detalle->subtotal, 2) }}</td>
                                <td>@include('layouts.estado', ['estado' => $detalle->estado])</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total</th>
                            <th colspan="2">₡{{ number_format($pedido->total, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-action">
            @if ($pedido->estado === 'Listo')
                <form action="{{ route('admin.pedidos.entregar', $pedido) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('¿Confirmar la entrega? El pedido ya no se podrá modificar.');">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Confirmar entrega</button>
                </form>
            @endif
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
@endsection