@extends('appTienda')

@section('tittle', 'Mi tienda')

@section('titulo', 'Mi tienda')

@section('subtitulo', 'Administra la información de tu tienda')

@section('contenido')
    @if (session('ok'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('ok') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tienda.mi-tienda.update') }}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Imágenes -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label fw-bold">Logo de la tienda</label>
                        <img id="vista-logo" src="{{ $tienda->logoUrl('300x300') }}" alt="Logo"
                            class="img-thumbnail mb-2 w-100" style="max-height: 260px; object-fit: contain;">
                        <input type="file" name="logo" id="logo" accept="image/png,image/jpeg,image/webp"
                            class="form-control @error('logo') is-invalid @enderror">
                        <small class="text-muted">JPG, PNG o WEBP. Máximo 2 MB. Recomendado 300 x 300 px.</small>

                        <label class="form-label fw-bold mt-4">Banner principal</label>
                        <img id="vista-banner" src="{{ $tienda->bannerUrl('600x200') }}" alt="Banner"
                            class="img-thumbnail mb-2 w-100" style="max-height: 160px; object-fit: cover;">
                        <input type="file" name="banner" id="banner" accept="image/png,image/jpeg,image/webp"
                            class="form-control @error('banner') is-invalid @enderror">
                        <small class="text-muted">JPG, PNG o WEBP. Máximo 4 MB. Recomendado 1200 x 400 px.</small>
                    </div>
                </div>
            </div>

            <!-- Datos -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre de la tienda</label>
                            <input type="text" id="nombre" name="nombre" maxlength="100"
                                value="{{ old('nombre', $tienda->nombre) }}"
                                class="form-control @error('nombre') is-invalid @enderror" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="4" maxlength="255"
                                class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $tienda->descripcion) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="whatsapp" class="form-label fw-bold">WhatsApp</label>
                                <input type="text" id="whatsapp" name="whatsapp" maxlength="16"
                                    value="{{ old('whatsapp', $tienda->whatsapp) }}"
                                    class="form-control @error('whatsapp') is-invalid @enderror" placeholder="88881111">
                                <small class="text-muted">Solo números (8 a 11).</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="telefono" class="form-label fw-bold">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" maxlength="9"
                                    value="{{ old('telefono', $tienda->telefono) }}"
                                    class="form-control @error('telefono') is-invalid @enderror" placeholder="22221111">
                                <small class="text-muted">8 números.</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="correo" class="form-label fw-bold">Correo electrónico</label>
                                <input type="email" id="correo" name="correo" maxlength="100"
                                    value="{{ old('correo', $tienda->correo) }}"
                                    class="form-control @error('correo') is-invalid @enderror" placeholder="tienda@correo.com">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="instagram" class="form-label fw-bold">Instagram</label>
                                <input type="text" id="instagram" name="instagram" maxlength="255"
                                    value="{{ old('instagram', $tienda->instagram) }}" class="form-control"
                                    placeholder="@mitienda o enlace">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="facebook" class="form-label fw-bold">Facebook</label>
                                <input type="text" id="facebook" name="facebook" maxlength="255"
                                    value="{{ old('facebook', $tienda->facebook) }}" class="form-control"
                                    placeholder="mitienda o enlace">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="youtube" class="form-label fw-bold">YouTube</label>
                                <input type="text" id="youtube" name="youtube" maxlength="255"
                                    value="{{ old('youtube', $tienda->youtube) }}" class="form-control"
                                    placeholder="@mitienda o enlace">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Vista previa de las imágenes elegidas antes de guardar
        function previsualizar(idInput, idImagen) {
            document.getElementById(idInput).addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    document.getElementById(idImagen).src = URL.createObjectURL(this.files[0]);
                }
            });
        }
        previsualizar('logo', 'vista-logo');
        previsualizar('banner', 'vista-banner');
    </script>
@endsection