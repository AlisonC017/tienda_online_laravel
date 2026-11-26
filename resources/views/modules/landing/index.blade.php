@extends('app')

@section('contenido')

    @if (session('ok'))
        <div id="avisoCompra" class="alert alert-success shadow"
            style="position: fixed; bottom: 20px; right: 20px; z-index: 2000; max-width: 350px;">
            {{ session('ok') }}
        </div>
        <script>
            setTimeout(function() {
                var a = document.getElementById('avisoCompra');
                if (a) a.remove();
            }, 5000);
        </script>
    @endif
    <!-- Carousel Start -->
    @if ($destacadas->isNotEmpty())
        <div @class(['container-fluid', 'p-0', 'pb-5'])>
            <div @class(['owl-carousel', 'header-carousel', 'position-relative'])>
                @foreach ($destacadas as $t)
                    <div @class(['owl-carousel-item', 'position-relative'])>
                        <img @class(['img-fluid', 'w-100']) style="height:480px;object-fit:cover"
                            src="{{ $t->bannerUrl('1400x480') }}" alt="Banner de {{ $t->nombre }}">
                        <div @class([
                            'position-absolute',
                            'top-0',
                            'start-0',
                            'w-100',
                            'h-100',
                            'd-flex',
                            'align-items-center',
                        ]) style="background: rgba(53, 53, 53, .7);">
                            <div @class(['container'])>
                                <div @class(['row', 'justify-content-center'])>
                                    <div @class(['col-12', 'col-lg-8', 'text-center'])>
                                        <img src="{{ $t->logoUrl('120x120') }}" @class([
                                            'rounded-circle',
                                            'border',
                                            'border-3',
                                            'border-white',
                                            'bg-white',
                                            'mb-3',
                                        ])
                                            style="width:120px;height:120px;object-fit:cover"
                                            alt="Logo de {{ $t->nombre }}">
                                        <h1 @class(['display-3', 'text-white', 'animated', 'slideInDown', 'mb-4'])
                                            style="font-family: 'Satisfy', cursive !important; text-shadow: 0 3px 10px rgba(0, 0, 0, 0.45);">
                                            {{ $t->nombre }}
                                        </h1>

                                        <a href="{{ route('tiendas.show', $t->id_tienda) }}"
                                            @class([
                                                'btn',
                                                'btn-primary',
                                                'py-md-3',
                                                'px-md-5',
                                                'animated',
                                                'slideInLeft',
                                            ])>Ver tienda</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!-- Carousel End -->

    <!-- Feature Start | Estadísticas del sitio -->
    <div @class(['container-xxl', 'py-5'])>
        <div @class(['container'])>
            <div @class(['row', 'g-3', 'justify-content-center'])>
                @php
                    $items = [
                        [
                            'icono' => 'fa-store',
                            'valor' => number_format($stats['tiendas'], 0, ',', '.'),
                            'texto' => 'Tiendas activas',
                        ],
                        [
                            'icono' => 'fa-shopping-bag',
                            'valor' => number_format($stats['ventas'], 0, ',', '.'),
                            'texto' => 'Ventas realizadas',
                        ],
                        [
                            'icono' => 'fa-coins',
                            'valor' => '₡' . number_format($stats['ganancias'], 0, ',', '.'),
                            'texto' => 'Total vendido',
                        ],
                    ];
                @endphp

                @foreach ($items as $item)
                    <div class="col-12 col-md-4 wow fadeIn" data-wow-delay="{{ 0.1 + $loop->index * 0.2 }}s">
                        <div
                            class="bg-white rounded-3 shadow-sm py-4 px-3 h-100 d-flex flex-column align-items-center justify-content-center text-center border">
                            <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                                <div class="d-flex align-items-center justify-content-center bg-white rounded-3 flex-shrink-0"
                                    style="width: 60px; height: 60px;">
                                    <i class="fa {{ $item['icono'] }} fa-2x text-primary"></i>
                                </div>
                                {{-- CAMBIO: se agregó data-stat --}}
                                <h2 class="display-6 text-primary mb-0 fw-bold" data-stat="{{ $loop->index }}">
                                    {{ $item['valor'] }}</h2>
                            </div>
                            <h5 class="text-muted mb-0 fw-normal">{{ $item['texto'] }}</h5>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Feature End -->

    <!-- Service Start | Productos mas vendidos -->
    <div @class(['container-xxl', 'py-5'])>
        <div @class(['container'])>
            <div @class(['section-title', 'text-center'])>
                <h1 @class(['display-5', 'mb-5']) style="font-family: 'Satisfy', cursive;">Productos más vendidos</h1>
            </div>
            <div @class(['row', 'g-4'])>
                @forelse ($topVentas as $p)
                    <div @class(['col-md-6', 'col-lg-3', 'wow', 'fadeInUp']) data-wow-delay="{{ 0.1 * (($loop->index % 4) + 1) }}s">
                        <div @class(['service-item', 'h-100'])>
                            <div @class(['overflow-hidden'])>
                                <img @class(['img-fluid', 'w-100']) style="height:220px;object-fit:cover"
                                    src="{{ $p->imagenUrl() }}" alt="{{ $p->nombre }}">
                            </div>
                            <div @class([
                                'p-4',
                                'text-center',
                                'border',
                                'border-5',
                                'border-light',
                                'border-top-0',
                            ])>
                                <h5 @class(['mb-1'])>{{ $p->nombre }}</h5>
                                <small @class(['text-muted', 'd-block', 'mb-2'])>{{ $p->tienda->nombre }}</small>
                                <p @class(['fw-bold', 'text-primary', 'mb-1'])>
                                    ₡{{ number_format($p->precio, 0, ',', '.') }}
                                </p>
                                <small @class(['d-block', 'mb-3'])>{{ (int) $p->total_vendido }}
                                    vendidos</small>
                                <a @class(['fw-medium']) href="{{ route('productos.show', $p->id_producto) }}">
                                    Ver producto<i @class(['fa', 'fa-arrow-right', 'ms-2'])></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p @class(['text-center', 'text-muted'])>Todavía no hay productos vendidos.</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Projects Start | tiendas -->
    <div @class(['container-xxl', 'py-5'])>
        <div @class(['container'])>
            <div @class(['section-title', 'text-center'])>
                <h1 @class(['display-5', 'mb-5']) style="font-family: 'Satisfy', cursive;">Tiendas</h1>
            </div>
            <div @class(['row', 'g-4'])>
                @forelse ($tiendas as $t)
                    <div @class(['col-lg-4', 'col-md-6', 'wow', 'fadeInUp']) data-wow-delay="{{ 0.1 * (($loop->index % 3) + 1) }}s">
                        <div @class(['rounded', 'overflow-hidden', 'h-100'])>
                            <div @class(['overflow-hidden'])>
                                <img @class(['img-fluid', 'w-100']) style="height:200px;object-fit:cover"
                                    src="{{ $t->bannerUrl('600x300') }}" alt="Banner de {{ $t->nombre }}">
                            </div>
                            <div @class([
                                'border',
                                'border-5',
                                'border-light',
                                'border-top-0',
                                'p-4',
                                'text-center',
                            ])>
                                <img src="{{ $t->logoUrl('80x80') }}" @class(['rounded-circle', 'mb-2'])
                                    style="width:60px;height:60px;object-fit:cover" alt="Logo de {{ $t->nombre }}">
                                <h5 @class(['mb-2'])>{{ $t->nombre }}</h5>
                                <p @class(['mb-3'])>
                                    {{ \Illuminate\Support\Str::limit($t->descripcion, 80) }}
                                </p>
                                <a @class(['fw-medium']) href="{{ route('tiendas.show', $t->id_tienda) }}">
                                    Ver tienda<i @class(['fa', 'fa-arrow-right', 'ms-2'])></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p @class(['text-center', 'text-muted'])>Todavía no hay tiendas registradas.</p>
                @endforelse
            </div>
            <div @class(['text-center', 'mt-5'])>
                <a href="{{ route('tiendas.index') }}" @class(['btn', 'btn-primary', 'py-3', 'px-5'])>Ver todas las tiendas</a>
            </div>
        </div>
    </div>
    <!-- Projects End -->

    <script>
        (function() {
            async function actualizarStats() {
                if (document.hidden) return;

                try {
                    const r = await fetch(window.location.pathname, {
                        credentials: 'same-origin',
                        cache: 'no-store'
                    });
                    if (!r.ok) return;

                    const doc = new DOMParser().parseFromString(await r.text(), 'text/html');

                    doc.querySelectorAll('[data-stat]').forEach(function(nuevo) {
                        const actual = document.querySelector('[data-stat="' + nuevo.dataset.stat + '"]');
                        if (actual && actual.textContent !== nuevo.textContent) {
                            actual.textContent = nuevo.textContent;
                        }
                    });
                } catch (e) {
                    // si falla la red, reintenta en el siguiente ciclo
                }
            }

            setInterval(actualizarStats, 5000);
        })();
    </script>
@endsection
