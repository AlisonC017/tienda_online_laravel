@extends('app')

@section('contenido')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5" style="font-family: 'Satisfy', cursive;">Productos</h1>
            </div>

            <div class="row g-4">

                <!-- Panel lateral de categorías -->
                <div class="col-lg-3 col-md-4">
                    <div class="bg-white p-3 border rounded shadow-sm">
                        <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">Categorías</h5>

                        <div class="list-group list-group-flush border-0">
                            <a href="{{ route('productos.index', array_filter(['q' => $busqueda])) }}"
                                class="list-group-item list-group-item-action border-0 rounded mb-1 d-flex justify-content-between align-items-center {{ !$categoriaId ? 'active fw-bold' : '' }}">
                                Todas <span class="fs-6">({{ $totalGeneral }})</span>
                            </a>
                            @foreach ($categorias as $categoria)
                                <a href="{{ route('productos.index', array_filter(['categoria' => $categoria->id_categoria, 'q' => $busqueda])) }}"
                                    class="list-group-item list-group-item-action border-0 rounded mb-1 d-flex justify-content-between align-items-center {{ $categoriaId == $categoria->id_categoria ? 'active fw-bold' : '' }}">
                                    {{ $categoria->nombre }} <span class="fs-6">({{ $categoria->total }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Listado de productos -->
                <div class="col-lg-9 col-md-8">

                    <form method="GET" action="{{ route('productos.index') }}" class="row g-2 mb-4">
                        @if ($categoriaId)
                            <input type="hidden" name="categoria" value="{{ $categoriaId }}">
                        @endif
                        <div class="col">
                            <input type="text" name="q" value="{{ $busqueda }}" class="form-control"
                                placeholder="Buscar producto por nombre..." maxlength="100">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>

                    <h5 class="mb-3">
                        {{ $categoriaActual ? $categoriaActual->nombre : 'Todos los productos' }}
                        <small class="text-muted">({{ $productos->total() }})</small>
                    </h5>

                    @if ($productos->isEmpty())
                        <div class="alert alert-light border text-center py-5">
                            No hay productos para mostrar.
                            <a href="{{ route('productos.index') }}">Ver todos los productos</a>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach ($productos as $producto)
                                <div class="col-lg-4 col-md-6">
                                    <div class="bg-white border rounded shadow-sm h-100 d-flex flex-column">
                                        <a href="{{ route('productos.show', $producto->id_producto) }}">
                                            <img src="{{ \App\Support\Imagen::url($producto->imagen, '400x300') }}"
                                                alt="{{ $producto->nombre }}" class="w-100 rounded-top"
                                                style="height: 200px; object-fit: cover;">
                                        </a>
                                        <div class="p-3 d-flex flex-column flex-grow-1">
                                            <h6 class="fw-bold text-dark mb-1">{{ $producto->nombre }}</h6>
                                            <small class="text-muted mb-2">
                                                <i class="fa fa-store me-1"></i>{{ $producto->tienda->nombre }}
                                            </small>
                                            <span class="h5 fw-bold text-primary mt-auto mb-3">
                                                ₡{{ number_format($producto->precio, 0, ',', '.') }}
                                            </span>
                                            <a href="{{ route('productos.show', $producto->id_producto) }}"
                                                class="btn btn-primary btn-sm rounded-pill">Ver detalle</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $productos->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
