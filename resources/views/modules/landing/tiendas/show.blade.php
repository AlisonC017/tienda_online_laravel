@extends('app')

@section('contenido')
    <div class="container-xxl py-5">
        <div class="container">

            <nav class="mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tiendas.index') }}">Tiendas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $tienda->nombre }}</li>
                </ol>
            </nav>

            <!-- Banner, logo y nombre -->
            <img src="{{ $tienda->bannerUrl('1200x300') }}" alt="Banner de {{ $tienda->nombre }}"
                class="w-100 rounded" style="height: 240px; object-fit: cover;">

            <div class="text-center">
                <img src="{{ $tienda->logoUrl('120x120') }}" alt="Logo de {{ $tienda->nombre }}"
                    class="rounded-circle border border-4 border-white bg-white shadow-sm"
                    style="width: 110px; height: 110px; object-fit: cover; margin-top: -55px;">
                <h2 class="mt-2">{{ $tienda->nombre }}</h2>

                <!-- Contactos y redes sociales -->
                <div class="d-flex justify-content-center flex-wrap gap-2 my-3">
                    @if ($tienda->whatsappUrl())
                        <a class="btn btn-outline-primary btn-sm" href="{{ $tienda->whatsappUrl() }}" target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp me-1"></i>{{ $tienda->whatsapp }}
                        </a>
                    @endif
                    @if ($tienda->telefonoUrl())
                        <a class="btn btn-outline-primary btn-sm" href="{{ $tienda->telefonoUrl() }}">
                            <i class="fa fa-phone-alt me-1"></i>{{ $tienda->telefono }}
                        </a>
                    @endif
                    @if ($tienda->correoContacto())
                        <a class="btn btn-outline-primary btn-sm" href="mailto:{{ $tienda->correoContacto() }}">
                            <i class="fa fa-envelope me-1"></i>{{ $tienda->correoContacto() }}
                        </a>
                    @endif
                    @if ($tienda->instagramUrl())
                        <a class="btn btn-outline-primary btn-sm" href="{{ $tienda->instagramUrl() }}" target="_blank" rel="noopener">
                            <i class="fab fa-instagram me-1"></i>Instagram
                        </a>
                    @endif
                    @if ($tienda->facebookUrl())
                        <a class="btn btn-outline-primary btn-sm" href="{{ $tienda->facebookUrl() }}" target="_blank" rel="noopener">
                            <i class="fab fa-facebook-f me-1"></i>Facebook
                        </a>
                    @endif
                    @if ($tienda->youtubeUrl())
                        <a class="btn btn-outline-primary btn-sm" href="{{ $tienda->youtubeUrl() }}" target="_blank" rel="noopener">
                            <i class="fab fa-youtube me-1"></i>YouTube
                        </a>
                    @endif
                </div>
            </div>

            @if ($tienda->descripcion)
                <p class="text-secondary mb-5 text-center mx-auto" style="max-width: 800px;">{!! nl2br(e($tienda->descripcion)) !!}</p>
            @endif

            <!-- Productos de la tienda -->
            <h4 class="mb-3">Productos de esta tienda</h4>
            @if ($productos->isEmpty())
                <div class="alert alert-light border">Esta tienda todavía no tiene productos disponibles.</div>
            @else
                <div class="row g-4 mb-5">
                    @foreach ($productos as $producto)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="bg-white border rounded shadow-sm h-100 d-flex flex-column">
                                <a href="{{ route('productos.show', $producto->id_producto) }}">
                                    <img src="{{ \App\Support\Imagen::url($producto->imagen, '300x220') }}"
                                        alt="{{ $producto->nombre }}" class="w-100 rounded-top"
                                        style="height: 170px; object-fit: cover;">
                                </a>
                                <div class="p-3 d-flex flex-column flex-grow-1">
                                    <h6 class="fw-bold text-dark mb-1">{{ $producto->nombre }}</h6>
                                    <span class="fw-bold text-primary mt-auto mb-2">
                                        ₡{{ number_format($producto->precio, 0, ',', '.') }}
                                    </span>
                                    <a href="{{ route('productos.show', $producto->id_producto) }}"
                                        class="btn btn-primary btn-sm rounded-pill">Ver detalle</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Formulario de contacto -->
            <div id="contacto" class="bg-white border rounded shadow-sm p-4">
                <h4 class="mb-3">Contactar a la tienda</h4>

                @if (session('ok'))
                    <div class="alert alert-success">{{ session('ok') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('tiendas.contacto', $tienda->id_tienda) }}" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                class="form-control @error('nombre') is-invalid @enderror" maxlength="100" required>
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" id="correo" name="correo" value="{{ old('correo') }}"
                                class="form-control @error('correo') is-invalid @enderror" maxlength="150" required>
                            @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea id="mensaje" name="mensaje" rows="5" maxlength="1000"
                                class="form-control @error('mensaje') is-invalid @enderror" required>{{ old('mensaje') }}</textarea>
                            @error('mensaje')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4">Enviar mensaje</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection