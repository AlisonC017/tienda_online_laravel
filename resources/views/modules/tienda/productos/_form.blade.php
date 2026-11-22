@php
    $editando = isset($producto);
    $seleccionadas = old('categorias', $editando ? $producto->categorias->pluck('id_categoria')->all() : []);
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" maxlength="150" required
                value="{{ old('nombre', $producto->nombre ?? '') }}">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" maxlength="255" required>{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio (₡)</label>
            <input type="number" id="precio" name="precio" class="form-control" step="0.01" min="0" required
                value="{{ old('precio', $producto->precio ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Categorías</label>
            @foreach ($categorias as $categoria)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categorias[]"
                        id="cat{{ $categoria->id_categoria }}" value="{{ $categoria->id_categoria }}"
                        {{ in_array($categoria->id_categoria, $seleccionadas) ? 'checked' : '' }}>
                    <label class="form-check-label" for="cat{{ $categoria->id_categoria }}">
                        {{ $categoria->nombre }}
                    </label>
                </div>
            @endforeach
            <small class="form-text text-muted">Elegí al menos una.</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="imagen">{{ $editando ? 'Cambiar imagen principal (opcional)' : 'Imagen principal' }}</label>
            <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*"
                {{ $editando ? '' : 'required' }}>
            @if ($editando)
                <img src="{{ asset('uploads/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="120"
                    class="rounded mt-2">
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="galeria">{{ $editando ? 'Agregar imágenes a la galería' : 'Galería (hasta 4 imágenes adicionales)' }}</label>
            <input type="file" id="galeria" name="galeria[]" class="form-control" accept="image/*" multiple>
            <small class="form-text text-muted">Máximo 4 imágenes adicionales en total, de hasta 2 MB cada una.</small>
        </div>
    </div>
</div>