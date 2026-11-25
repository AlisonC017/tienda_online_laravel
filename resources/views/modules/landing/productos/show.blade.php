@extends('app')

@section('contenido')
    @php
        // Imagen principal + galería (máximo 4 adicionales)
        $fotos = collect([\App\Support\Imagen::url($producto->imagen, '600x600')])
            ->merge($producto->imagenes->take(4)->map(fn ($i) => \App\Support\Imagen::url($i->imagen, '600x600')));
    @endphp

    <div class="container-xxl py-5">
        <div class="container">

            <!-- Breadcrumb -->
            <nav class="mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $producto->nombre }}</li>
                </ol>
            </nav>

            @if (session('ok'))
                <div class="alert alert-success">{{ session('ok') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">

                <!-- Galería de imágenes -->
                <div class="col-md-6">
                    <img id="imagen-principal" src="{{ $fotos->first() }}" alt="{{ $producto->nombre }}"
                        class="img-fluid rounded w-100 border" style="max-height: 520px; object-fit: contain;">

                    @if ($fotos->count() > 1)
                        <div class="row g-2 mt-1">
                            @foreach ($fotos as $foto)
                                <div class="col-3">
                                    <img src="{{ $foto }}" alt="Vista {{ $loop->iteration }} de {{ $producto->nombre }}"
                                        class="img-fluid rounded border miniatura {{ $loop->first ? 'border-primary' : '' }}"
                                        style="cursor: pointer; height: 90px; width: 100%; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Información del producto -->
                <div class="col-md-6">
                    <h2>{{ $producto->nombre }}</h2>

                    <p class="mb-2">
                        Tienda: {{ $producto->tienda->nombre }}
                        <a href="{{ route('tiendas.show', $producto->tienda->id_tienda) }}" class="ms-2">Ver tienda</a>
                    </p>

                    <h3 class="fw-bold text-primary">₡{{ number_format($producto->precio, 0, ',', '.') }}</h3>

                    <form method="POST" action="{{ route('carrito.store') }}" class="mt-4">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">

                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <div class="input-group mb-3" style="max-width: 160px;">
                            <button type="button" class="btn btn-outline-secondary" id="menos" aria-label="Disminuir">−</button>
                            <input type="number" id="cantidad" name="cantidad" class="form-control text-center"
                                value="1" min="1" max="99">
                            <button type="button" class="btn btn-outline-secondary" id="mas" aria-label="Aumentar">+</button>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-4">
                            <i class="fa fa-shopping-cart me-2"></i>Agregar al carrito
                        </button>
                    </form>

                    <h5>Descripción del producto</h5>
                    <p class="text-secondary">{!! nl2br(e($producto->descripcion)) !!}</p>

                    <h5>Categorías</h5>
                    @forelse ($producto->categorias as $categoria)
                        <a href="{{ route('productos.index', ['categoria' => $categoria->id_categoria]) }}"
                            class="badge rounded-pill bg-light text-dark border text-decoration-none">
                            {{ $categoria->nombre }}
                        </a>
                    @empty
                        <span class="text-muted">Sin categoría</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascrip')
    <script>
        $(function() {
            var $cantidad = $('#cantidad');

            function valor() {
                var n = parseInt($cantidad.val(), 10);
                return isNaN(n) || n < 1 ? 1 : Math.min(n, 99);
            }

            $('#mas').on('click', function() {
                $cantidad.val(Math.min(valor() + 1, 99));
            });
            $('#menos').on('click', function() {
                $cantidad.val(Math.max(valor() - 1, 1));
            });
            $cantidad.on('change', function() {
                $cantidad.val(valor());
            });

            // Cambiar la imagen principal al hacer clic en una miniatura
            $('.miniatura').on('click', function() {
                $('#imagen-principal').attr('src', $(this).attr('src'));
                $('.miniatura').removeClass('border-primary');
                $(this).addClass('border-primary');
            });
        });
    </script>
@endsection