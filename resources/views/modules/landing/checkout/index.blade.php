@extends('app')

@section('contenido')
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="display-6 mb-4" style="font-family: 'Satisfy', cursive;">Finalizar pedido</h1>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">
                <!-- Información del cliente -->
                <div class="col-lg-6">
                    <form action="{{ route('pedido.store') }}" method="POST" class="border rounded p-4">
                        @csrf
                        <h5 class="mb-3">Información del cliente</h5>

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="cliente" value="{{ old('cliente') }}" class="form-control"
                                placeholder="Tu nombre completo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="correo" value="{{ old('correo') }}" class="form-control"
                                placeholder="tu@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono (opcional)</label>
                            <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control"
                                placeholder="Tu número de teléfono">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-shopping-cart me-2"></i>Confirmar pedido
                        </button>
                    </form>
                </div>

                <!-- Resumen del pedido -->
                <div class="col-lg-6">
                    <div class="border rounded p-4">
                        <h5 class="mb-3">Resumen del pedido</h5>

                        @foreach ($data as $item)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <strong>{{ $item->producto->nombre }}</strong>
                                    <small class="d-block text-muted">{{ $item->producto->tienda->nombre }}</small>
                                    <small>₡{{ number_format($item->producto->precio, 0, ',', '.') }} x
                                        {{ $item->cantidad }}</small>
                                </div>
                                <span>₡{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between pt-3">
                            <h5>Total:</h5>
                            <h5>₡{{ number_format($total, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
