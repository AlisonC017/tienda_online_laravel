@extends('app')
@section('title', 'Detalle de la tienda')

@section('contenido')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tiendas.index') }}">Tiendas</a></li>
            <li class="breadcrumb-item active">Mundo Tech</li>
        </ol>
    </nav>

    @if (session('ok'))
        <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    <img src="https://placehold.co/1200x200?text=Banner" class="img-fluid rounded w-100" alt="Banner">

    <div class="text-center">
        <img src="https://placehold.co/100x100?text=Logo" class="rounded-circle border border-3 border-white bg-white"
             style="width:100px;height:100px;margin-top:-50px" alt="Logo">
        <h3 class="fw-bold mt-2">Mundo Tech</h3>

        <div class="d-flex justify-content-center flex-wrap gap-4 my-3">
            <a href="https://wa.me/50687777777" class="text-dark text-decoration-none">WhatsApp</a>
            <a href="tel:+50687777777" class="text-dark text-decoration-none">Teléfono</a>
            <a href="mailto:contacto@mundotech.com" class="text-dark text-decoration-none">Correo</a>
            <a href="https://instagram.com" class="text-dark text-decoration-none">Instagram</a>
            <a href="https://facebook.com" class="text-dark text-decoration-none">Facebook</a>
            <a href="https://youtube.com" class="text-dark text-decoration-none">YouTube</a>
        </div>
    </div>

    <p class="mb-4">Tienda especializada en tecnología y accesorios. Envíos a todo el país y garantía en todos nuestros productos.</p>

    <h5 class="fw-bold">Productos de esta tienda</h5>
    <div class="row g-3 mb-5">
        @foreach ([['id' => 1, 'n' => 'Audífonos Bluetooth', 'p' => 25000], ['id' => 9, 'n' => 'Teclado mecánico', 'p' => 45000], ['id' => 10, 'n' => 'Mouse inalámbrico', 'p' => 12500], ['id' => 11, 'n' => 'Cargador rápido', 'p' => 9500]] as $p)
            <div class="col-6 col-md-3">
                <div class="card h-100">
                    <img src="https://placehold.co/300x220?text=Producto" class="card-img-top" alt="{{ $p['n'] }}">
                    <div class="card-body">
                        <h6 class="mb-1">{{ $p['n'] }}</h6>
                        <p class="fw-bold mb-0">₡{{ number_format($p['p'], 0, ',', '.') }}</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('productos.show', $p['id']) }}" class="btn btn-dark w-100">Ver detalle</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold">Contactar a la tienda</h5>
            <form method="POST" action="{{ route('tiendas.contacto', 2) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Mensaje</label>
                        <textarea name="mensaje" rows="4" class="form-control" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark">Enviar mensaje</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
