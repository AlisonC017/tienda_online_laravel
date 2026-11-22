@extends('app')
@section('title', 'Tiendas')

@section('contenido')
@php
    $tiendas = [
        ['id' => 1, 'nombre' => 'Tienda Verde', 'descripcion' => 'Productos naturales y para el hogar.'],
        ['id' => 2, 'nombre' => 'Mundo Tech', 'descripcion' => 'Tecnología y accesorios.'],
        ['id' => 3, 'nombre' => 'Hogar y Estilo', 'descripcion' => 'Decoración y muebles.'],
        ['id' => 4, 'nombre' => 'Moda Express', 'descripcion' => 'Ropa y accesorios de temporada.'],
        ['id' => 5, 'nombre' => 'Deportes CR', 'descripcion' => 'Equipo e indumentaria deportiva.'],
        ['id' => 6, 'nombre' => 'Peques y Más', 'descripcion' => 'Juguetes y artículos infantiles.'],
    ];
@endphp

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Todas las tiendas</h4>
        <input type="search" class="form-control w-auto" placeholder="Buscar tiendas...">
    </div>

    <div class="row g-3">
        @foreach ($tiendas as $t)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 text-center overflow-hidden">
                    <img src="https://placehold.co/600x180?text=Banner" class="card-img-top" alt="Banner de {{ $t['nombre'] }}">
                    <img src="https://placehold.co/80x80?text=Logo" class="rounded-circle border border-3 border-white bg-white mx-auto"
                         style="width:80px;height:80px;margin-top:-40px" alt="Logo de {{ $t['nombre'] }}">
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $t['nombre'] }}</h6>
                        <p class="small text-muted">{{ $t['descripcion'] }}</p>
                        <a href="{{ route('tiendas.show', $t['id']) }}" class="btn btn-dark btn-sm">Ver tienda</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection