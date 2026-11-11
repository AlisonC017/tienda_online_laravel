@extends('app')

@section('contenido')
    <div class="container-xxl py-5">
        <div class="container">

            <div class="container my-5">

                <!-- Breadcrumb -->
                <nav class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Inicio</li>
                        <li class="breadcrumb-item">Productos</li>
                        <li class="breadcrumb-item active">
                            Nombre del producto
                        </li>
                    </ol>
                </nav>

                <div class="row g-4">

                    <!-- Galería de imágenes -->
                    <div class="col-md-6">
                        <img src="https://placehold.co/600x600" class="img-fluid rounded w-100" alt="Producto">

                        <div class="row g-2 mt-1">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="col-3">
                                    <img src="https://placehold.co/150x150" class="img-fluid rounded"
                                        alt="Vista del producto">
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Información del producto -->
                    <div class="col-md-6">

                        <h2>Nombre del producto</h2>

                        <p>
                            Tienda de ejemplo
                            <a href="#">Ver tienda</a>
                        </p>

                        <h3 class="fw-bold">₡25.000</h3>

                        <label class="form-label mt-3">Cantidad:</label>

                        <div class="input-group mb-3" style="max-width: 150px;">
                            <button class="btn btn-outline-secondary">−</button>
                            <input type="number" class="form-control text-center" value="1" min="1">
                            <button class="btn btn-outline-secondary">+</button>
                        </div>

                        <button class="btn btn-dark w-100 mb-4"> Agregar al carrito </button>

                        <h5>Descripción del producto</h5>
                        <p class="text-secondary">
                            Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Sed do eiusmod tempor.
                        </p>

                        <h5>Categorías</h5>

                        <span class="badge rounded-pill bg-light text-dark">
                            Tecnología
                        </span>

                        <span class="badge rounded-pill bg-light text-dark">
                            Accesorios
                        </span>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('javascrip')
@endsection
