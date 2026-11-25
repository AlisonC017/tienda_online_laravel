<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('tienda.index') }}" class="logo">
                <img src="{{ asset('uploads/logo.png') }}" alt="navbar brand" class="navbar-brand"
                    style="height: 118px; width: auto; max-height: none; margin-left:-19px; background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.164) 0%, rgba(255, 255, 255, 0) 72%);" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <!-- Tiendas -->
                <li class="nav-item">
                   <a href="{{ route('tienda.mi-tienda') }}">
                        <i class="fas fa-store"></i>
                        <p>Mi tienda</p>
                    </a>
                </li>

                <!-- Productos -->
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-shopping-bag"></i>
                        <p>Mis productos</p>
                    </a>
                </li>

                <!-- Pedidos -->
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-shopping-bag"></i>
                        <p>Mis Pedidos</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
