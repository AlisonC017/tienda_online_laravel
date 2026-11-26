<div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Columna 1: 4 espacios -->
            <div class="col-lg-4 col-md-6">
                <h4 class="text-light mb-4" style="font-family: 'Satisfy', cursive;">Dirección y Contacto</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Siquirres, Limón, Costa Rica</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+506 0000 0000</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>crikoStore.info@gmail.com</p>
                <div class="d-flex pt-2 gap-1">
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-whatsapp"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fas fa-envelope"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fas fa-phone-alt"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Columna 2: 2 espacios -->
            <div class="col-lg-2 col-md-6">
                <h4 class="text-light mb-4" style="font-family: 'Satisfy', cursive;">Enlaces</h4>
                <a class="btn btn-link" href="{{ route('inicio') }}">Inicio</a>
                <a class="btn btn-link" href="{{ route('productos.index') }}">Productos</a>
                <a class="btn btn-link" href="{{ route('tiendas.index') }}">Tiendas</a>
                <a class="btn btn-link" href="#">Carrito</a>
            </div>

            <!-- Columna 3: 3 espacios -->
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4" style="font-family: 'Satisfy', cursive;">¿Qué es CrickoStore?</h4>
                <p class="mb-0">Un directorio comercial donde varias tiendas locales ofrecen sus productos y tú puedes
                    armar un solo pedido con todas ellas.</p>
            </div>

            <!-- Columna 4: 3 espacios -->
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4" style="font-family: 'Satisfy', cursive;">¿Tienes una tienda?</h4>
                <p>Publica tus productos en nuestro directorio y llega a más clientes en toda la zona.</p>
                <a href="{{ route('register') }}" class="btn btn-primary py-2 px-4">Registrar mi tienda</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">Grupo #3 - UCR</a> | Todos los derechos reservados.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    Diseñado por <a class="border-bottom" href="#">Ali XD</a>
                </div>
            </div>
        </div>
    </div>
</div>
