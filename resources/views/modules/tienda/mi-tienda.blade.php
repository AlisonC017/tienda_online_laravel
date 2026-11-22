@extends('appTienda')

@section('tittle', 'Mi tienda')

@section('titulo', 'Mi tienda')

@section('subtitulo', 'Administra la información de tu tienda')

@section('contenido')
<div class="container-fluid py-4">
    @if (session('ok'))
        <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    <form method="POST" action="{{ route('tienda.mi-tienda.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-md-4">
                <label class="form-label fw-bold">Logo de la tienda</label>
                <img src="https://placehold.co/300x300?text=Logo" class="img-thumbnail mb-2 w-100" alt="Logo">
                <input type="file" name="logo" class="form-control mb-1" accept="image/*">
                <small class="text-muted">Recomendado: 300 x 300 px</small>

                <label class="form-label fw-bold mt-4">Banner principal</label>
                <img src="https://placehold.co/600x200?text=Banner" class="img-thumbnail mb-2 w-100" alt="Banner">
                <input type="file" name="banner" class="form-control mb-1" accept="image/*">
                <small class="text-muted">Recomendado: 1200 x 400 px</small>
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Nombre de la tienda</label>
                    <input type="text" name="nombre" class="form-control" value="Mundo Tech">
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" rows="4" class="form-control">Tienda especializada en tecnología y accesorios.</textarea>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control" value="8777-7777">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="2222-2222">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" class="form-control" value="contacto@mundotech.com">
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="@mundotech">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="mundotech">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">YouTube</label>
                        <input type="text" name="youtube" class="form-control" value="https://youtube.com/@mundotech">
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Guardar cambios</button>
            </div>
        </div>
    </form>
</div>
@endsection
