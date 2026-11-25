@extends('app')

@section('contenido')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Tiendas</h1>
            </div>

            <form method="GET" action="{{ route('tiendas.index') }}" class="row g-2 justify-content-center mb-5">
                <div class="col-md-6">
                    <input type="text" name="q" value="{{ $busqueda }}" class="form-control"
                        placeholder="¿Qué tienda buscas?" maxlength="100">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            @if ($tiendas->isEmpty())
                <div class="alert alert-light border text-center py-5">
                    No se encontraron tiendas.
                    <a href="{{ route('tiendas.index') }}">Ver todas</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($tiendas as $tienda)
                        <div class="col-lg-4 col-md-6">
                            <div class="bg-white border rounded shadow-sm h-100 text-center overflow-hidden">
                                <img src="{{ $tienda->bannerUrl('600x180') }}" alt="Banner de {{ $tienda->nombre }}"
                                    class="w-100" style="height: 150px; object-fit: cover;">
                                <img src="{{ $tienda->logoUrl('96x96') }}" alt="Logo de {{ $tienda->nombre }}"
                                    class="rounded-circle border border-3 border-white bg-white"
                                    style="width: 90px; height: 90px; object-fit: cover; margin-top: -45px;">
                                <div class="p-3">
                                    <h5 class="fw-bold text-dark">{{ $tienda->nombre }}</h5>
                                    <p class="text-muted small">{{ \Illuminate\Support\Str::limit($tienda->descripcion, 90) }}</p>
                                    <a href="{{ route('tiendas.show', $tienda->id_tienda) }}"
                                        class="btn btn-primary btn-sm rounded-pill px-4">Ver tienda</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $tiendas->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection