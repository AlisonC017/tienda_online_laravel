@extends('app')

@section('contenido')

    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="display-6 mb-4">Carrito de compras</h1>

            @if (session('ok'))
                <div class="alert alert-success">{{ session('ok') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('carrito.store') }}" method="POST" class="row g-2 mb-4 p-3 border rounded bg-light">
                @csrf
                <div class="col-auto">
                    <input type="number" name="id_producto" class="form-control" placeholder="id_producto" required>
                </div>
                <div class="col-auto">
                    <input type="number" name="cantidad" class="form-control" value="1" min="1" required>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Agregar (prueba)</button>
                </div>
            </form>

            @if ($data->isEmpty())
                <p class="text-muted">Tu carrito está vacio.</p>
                <a href="/p" class="btn btn-primary">Ver productos</a>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Tienda</th>
                                <th>Precio</th>
                                <th style="width:150px">Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->producto->nombre }}</td>
                                    <td>{{ $item->producto->tienda->nombre }}</td>
                                    <td>₡{{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('carrito.update', $item->producto->id_producto) }}"
                                            method="POST" class="d-flex gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="cantidad" value="{{ $item->cantidad }}"
                                                min="1" max="99" class="form-control form-control-sm">
                                            <button class="btn btn-sm btn-outline-primary">OK</button>
                                        </form>
                                    </td>
                                    <td>₡{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('carrito.destroy', $item->producto->id_producto) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Quitar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="/p" class="btn btn-outline-secondary">← Seguir comprando</a>
                    <div class="text-end">
                        <h4>Total: ₡{{ number_format($total, 0, ',', '.') }}</h4>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">Finalizar pedido</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
