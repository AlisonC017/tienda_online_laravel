@extends('app')
@section('title', 'Detalle del producto')

@section('contenido')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
            <li class="breadcrumb-item active">Audífonos Bluetooth</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-md-6">
            <img id="imgPrincipal" src="https://placehold.co/600x600?text=Principal" class="img-fluid rounded mb-2" alt="Producto">
            <div class="row g-2">
                @foreach (['Galería 1', 'Galería 2', 'Galería 3', 'Galería 4'] as $g)
                    <div class="col-3">
                        <img src="https://placehold.co/150x150?text={{ urlencode($g) }}" class="img-thumbnail" style="cursor:pointer"
                             onclick="document.getElementById('imgPrincipal').src = this.src.replace('150x150', '600x600')" alt="{{ $g }}">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <h3 class="fw-bold">Audífonos Bluetooth</h3>
            <p class="text-muted">Tienda: <a href="{{ route('tiendas.show', 2) }}">Mundo Tech</a></p>
            <h4 class="fw-bold mb-3">₡25.000</h4>

            <label class="form-label">Cantidad</label>
            <div class="input-group mb-3" style="max-width:150px">
                <button class="btn btn-outline-secondary" type="button" onclick="cambiar(-1)">−</button>
                <input type="text" id="cantidad" class="form-control text-center" value="1" readonly>
                <button class="btn btn-outline-secondary" type="button" onclick="cambiar(1)">+</button>
            </div>

            <a href="{{ url('/carrito') }}" class="btn btn-dark w-100 mb-4">Agregar al carrito</a>

            <h6 class="fw-bold">Descripción del producto</h6>
            <p>Audífonos inalámbricos con cancelación de ruido, hasta 30 horas de batería y micrófono integrado.</p>

            <h6 class="fw-bold">Categorías</h6>
            <span class="badge rounded-pill bg-light text-dark border">Tecnología</span>
            <span class="badge rounded-pill bg-light text-dark border">Accesorios</span>
        </div>
    </div>
</div>
@endsection

@section('javascrip')
<script>
    function cambiar(n) {
        const i = document.getElementById('cantidad');
        i.value = Math.max(1, parseInt(i.value) + n);
    }
</script>
@endsection
