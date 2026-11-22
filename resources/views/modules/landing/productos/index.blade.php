@extends('app')
@section('title', 'Productos')

@section('contenido')
@php
    $categorias = ['Todas' => 120, 'Tecnología' => 28, 'Hogar' => 15, 'Moda' => 22, 'Belleza' => 10, 'Deportes' => 14, 'Juguetes' => 8, 'Alimentos' => 8, 'Mascotas' => 6];
    $productos = [
        ['id' => 1, 'nombre' => 'Audífonos Bluetooth', 'tienda' => 'Mundo Tech', 'precio' => 25000],
        ['id' => 2, 'nombre' => 'Lámpara de escritorio', 'tienda' => 'Hogar y Estilo', 'precio' => 18500],
        ['id' => 3, 'nombre' => 'Camiseta deportiva', 'tienda' => 'Moda Express', 'precio' => 12000],
        ['id' => 4, 'nombre' => 'Crema hidratante', 'tienda' => 'Belleza Natural', 'precio' => 9800],
        ['id' => 5, 'nombre' => 'Balón de fútbol', 'tienda' => 'Deportes CR', 'precio' => 15000],
        ['id' => 6, 'nombre' => 'Set de bloques', 'tienda' => 'Peques y Más', 'precio' => 14500],
        ['id' => 7, 'nombre' => 'Café molido 500g', 'tienda' => 'Tienda Verde', 'precio' => 6500],
        ['id' => 8, 'nombre' => 'Cama para mascota', 'tienda' => 'Tienda Verde', 'precio' => 22000],
        ['id' => 9, 'nombre' => 'Teclado mecánico', 'tienda' => 'Mundo Tech', 'precio' => 45000],
    ];
@endphp

<div class="container py-4">
    <div class="row">
        <aside class="col-md-3 mb-4">
            <h6 class="fw-bold">Categorías</h6>
            <div class="list-group">
                @foreach ($categorias as $nombre => $cantidad)
                    <a href="{{ route('productos.index') }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between {{ $loop->first ? 'active' : '' }}">
                        {{ $nombre }} <span>({{ $cantidad }})</span>
                    </a>
                @endforeach
            </div>
        </aside>

        <section class="col-md-9">
            <h4 class="fw-bold mb-3">Todos los productos</h4>
            <div class="row g-3">
                @foreach ($productos as $p)
                    <div class="col-6 col-lg-4">
                        <div class="card h-100">
                            <img src="https://placehold.co/400x300?text=Producto" class="card-img-top" alt="{{ $p['nombre'] }}">
                            <div class="card-body">
                                <h6 class="card-title mb-1">{{ $p['nombre'] }}</h6>
                                <small class="text-muted d-block">{{ $p['tienda'] }}</small>
                                <p class="fw-bold mt-2 mb-0">₡{{ number_format($p['precio'], 0, ',', '.') }}</p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="{{ route('productos.show', $p['id']) }}" class="btn btn-dark w-100">Ver detalle</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection
