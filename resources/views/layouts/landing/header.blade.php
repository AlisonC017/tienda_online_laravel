<!-- Topbar Start -->
<div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-map-marker-alt text-primary me-2"></small>
                <small>Siquirres, Limón, Costa Rica</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="far fa-clock text-primary me-2"></small>
                <small>Lunes - Sábado : 09.00 AM - 10.00 PM</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-phone-alt text-primary me-2"></small>
                <small>+506 0000 0000 </small>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i
                        class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i
                        class="fab fa-youtube"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary">CrikoStore</h2>
    </a>

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0 align-items-lg-center">
            <a href="#" class="nav-item nav-link active">Inicio</a>
            <a href="#" class="nav-item nav-link">Productos</a>
            <a href="#" class="nav-item nav-link">Tiendas</a>
            <a href="contact.html" class="nav-item nav-link">Contacto</a>

            <!-- Buscador  -->
            <form id="search-form" action="#" method="get" class="my-2 my-lg-0 me-lg-3">
                <div class="input-group input-group-sm border rounded-pill bg-light overflow-hidden"
                    style="max-width: 600px;">
                    <select class="form-select border-0 bg-transparent ps-3 pe-1 text-muted"
                        style="max-width: 95px; font-size: 0.8rem;">
                        <option value="">Todas</option>
                        <option value="groceries">Abarrotes</option>
                        <option value="drinks">Bebidas</option>
                        <option value="chocolates">Chocolates</option>
                    </select>
                    <span class="border-end my-1"></span>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none"
                        placeholder="Buscar..." aria-label="Buscar" style="font-size: 0.8rem;">
                    <button class="btn border-0 text-primary pe-3" type="submit" aria-label="Buscar">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Carrito de Compras  -->
            <div class="cart text-end d-none d-lg-block">
                <button
                    class="btn border-0 bg-transparent d-inline-flex align-items-center gap-3 p-0 shadow-none text-start"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                    aria-controls="offcanvasCart">
                    <i class="fa fa-shopping-cart fs-3 text-primary"></i>
                    <div class="d-flex flex-column lh-sm">
                        <span class="fs-6 text-muted">Tu Carrito</span>
                        <span class="cart-total fs-5 fw-bold text-dark">$1,290.00</span>
                    </div>
                </button>
            </div>

            @include('layouts.landing.carritoLateral')

        </div>

        <!--  Get A Quote  -->
        <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block rounded-0 ms-4">
            Iniciar Sesión<i class="fa fa-arrow-right ms-3"></i>
        </a>
    </div>
</nav>
<!-- Navbar End -->
