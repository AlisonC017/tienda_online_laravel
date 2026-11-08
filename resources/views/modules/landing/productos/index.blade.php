@extends('app')

@section('contenido')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Productos</h1>
            </div>

            <div class="row g-4">

                <!-- menu lateral de categorias -->
                <div class="col-lg-3 col-md-4">
                    <div class="bg-white p-3 border rounded shadow-sm">
                        <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">Categorías</h5>

                        <div class="list-group list-group-flush border-0">
                            <a href="#"
                                class="list-group-item list-group-item-action border-0 rounded fw-bold active bg-light text-dark mb-1 d-flex justify-content-between align-items-center">
                                Todas <span class="text-muted fs-6 font-monospace">(120)</span>
                            </a>
                            <a href="#"
                                class="list-group-item list-group-item-action border-0 rounded text-muted mb-1 d-flex justify-content-between align-items-center">
                                Tecnología <span class="text-muted fs-6">(28)</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Todos los Productos -->
                <div class="col-lg-9 col-md-8">

                    <div class="row g-4">

                        <!-- Tarjeta de Producto 1 -->
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div
                                class="product-item position-relative bg-white border rounded p-3 h-100 d-flex flex-column justify-content-between shadow-sm">

                                <!-- Badge de Descuento y Wishlist -->
                                <span class="badge bg-success position-absolute top-0 start-0 m-3 z-1">-15%</span>
                                <a href="#" class="btn-wishlist position-absolute top-0 end-0 m-3 text-muted"
                                    title="Guardar en favoritos">
                                    <i class="far fa-heart fs-5"></i>
                                </a>

                                <!-- Imagen del Producto -->
                                <figure class="text-center my-3 overflow-hidden">
                                    <a href="#" title="Sunstar Fresh Melon Juice">
                                        <img src="img/service-1.jpg" class="img-fluid rounded"
                                            alt="Sunstar Fresh Melon Juice" style="max-height: 180px; object-fit: contain;">
                                    </a>
                                </figure>

                                <!-- Detalles del Producto -->
                                <div>
                                    <h5 class="fw-bold mb-2 text-dark fs-6">Sunstar Fresh Melon Juice</h5>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted small">1 Unidad</span>
                                        <span class="rating text-warning small fw-bold">
                                            <i class="fa fa-star me-1"></i>4.5
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="price h5 fw-bold text-primary mb-0">$18.00</span>
                                    </div>
                                </div>

                                <!-- Controles de Cantidad y Botones -->
                                <div class="d-flex flex-column gap-2 pt-2 border-top">
                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                        <div class="input-group input-group-sm product-qty" style="max-width: 90px;">
                                            <button type="button" class="btn btn-outline-secondary px-2 quantity-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control text-center px-1 quantity-input"
                                                value="1" min="1">
                                            <button type="button" class="btn btn-outline-secondary px-2 quantity-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>

                                        <div class="d-flex align-items-center gap-1">
                                            <button type="button"
                                                class="btn btn-primary btn-sm px-2 rounded-pill d-flex align-items-center">
                                                <span>Ver </span>
                                            </button>

                                            <button type="button"
                                                class="btn btn-primary btn-sm px-2 rounded-pill d-flex align-items-center gap-1">
                                                <span>Agregar</span>
                                                <i class="fa fa-shopping-cart ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascrip')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Incrementar cantidad
            document.querySelectorAll('.quantity-plus').forEach(button => {
                button.addEventListener('click', function() {
                    let input = this.parentElement.querySelector('.quantity-input');
                    input.value = parseInt(input.value) + 1;
                });
            });

            // Decrementar cantidad
            document.querySelectorAll('.quantity-minus').forEach(button => {
                button.addEventListener('click', function() {
                    let input = this.parentElement.querySelector('.quantity-input');
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                    }
                });
            });
        });
    </script>
@endsection
