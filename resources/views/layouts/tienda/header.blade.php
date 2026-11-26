@php
    $tiendaHeader = Auth::user()->tienda;
    $avatar =
        $tiendaHeader && $tiendaHeader->logo && file_exists(public_path('uploads/' . basename($tiendaHeader->logo)))
            ? asset('uploads/' . basename($tiendaHeader->logo))
            : Auth::user()->imagen();
@endphp

<div class="main-header">
    <div class="main-header-logo">

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

    </div>

    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </form>
                    </ul>
                </li>

                <!-- Notificaciones de pedidos pendientes -->
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell text-dark fs-5"></i>
                        @if ($notificacionesPanel->count() > 0)
                            <span
                                class="notification bg-warning text-dark fw-bold">{{ $notificacionesPanel->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">
                                {{ $notificacionesPanel->count() > 0
                                    ? 'Tienes ' .
                                        $notificacionesPanel->count() .
                                        ' ' .
                                        ($notificacionesPanel->count() === 1 ? 'pedido pendiente' : 'pedidos pendientes')
                                    : 'No tienes notificaciones nuevas' }}
                            </div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    @forelse ($notificacionesPanel as $notif)
                                        <a href="{{ $notif['url'] }}">
                                            <div class="notif-icon notif-warning">
                                                <i class="fas {{ $notif['icono'] }} text-white"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">{{ $notif['titulo'] }}</span>
                                                <span class="time">{{ $notif['tiempo'] }}</span>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center text-muted py-3 small">
                                            Todo está al día
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all"
                                href="{{ Auth::user()->rol === 'administrador' ? route('admin.pedidos.index') : route('tienda.pedidos.index') }}">
                                Ver todos los pedidos <i class="fas fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ $avatar }}" alt="Foto de perfil" referrerpolicy="no-referrer"
                                onerror="this.onerror=null;this.src='{{ asset('uploads/user.png') }}'"
                                class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hola,</span>
                            <span class="fw-bold">{{ Auth::user()->nombre }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ $avatar }}" alt="Foto de perfil"
                                            referrerpolicy="no-referrer"
                                            onerror="this.onerror=null;this.src='{{ asset('uploads/user.png') }}'"
                                            class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->nombre }}</h4>
                                        <p class="text-muted">{{ Auth::user()->correo }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
