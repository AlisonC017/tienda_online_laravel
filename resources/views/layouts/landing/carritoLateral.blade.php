<!-- PANEL LATERAL DESPLEGABLE -->
<div class="offcanvas offcanvas-end p-3" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel"
    style="width: 380px;">

    <div class="offcanvas-header border-bottom pb-3">
        <div class="d-flex align-items-center gap-2">
            <h4 class="offcanvas-title fw-bold m-0" id="offcanvasCartLabel"
                style="color: #8f5b11; font-family: 'Satisfy', cursive; font-size: 1.75rem;">
                Carrito de Compras</h4>
            <span class="badge rounded-circle bg-warning text-white fs-6">{{ $carritoCantidad }}</span>
        </div>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between py-3">
        <div class="cart-list">
            @forelse ($carritoData as $item)
                <div class="d-flex justify-content-between align-items-start py-2 border-bottom">
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $item->producto->nombre }}</h6>
                        <small class="text-muted">{{ $item->producto->tienda->nombre }}</small>
                        <small class="d-block">
                            ₡{{ number_format($item->producto->precio, 0, ',', '.') }} x {{ $item->cantidad }}
                        </small>
                    </div>
                    <span class="fw-bold text-secondary">₡{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            @empty
                <p class="text-muted text-center my-4">Tu carrito está vacío </p>
            @endforelse

            <div class="d-flex justify-content-between align-items-center pt-3">
                <span class="text-muted fs-5">Total</span>
                <span class="fw-bold fs-5 text-dark">₡{{ number_format($carritoTotal, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="pt-3 d-grid gap-2">
            <a href="{{ route('carrito.index') }}"
                class="btn text-white fw-semibold rounded-3 shadow-sm d-flex align-items-center justify-content-center"
                style="background-color:  #8f5b11; height: 42px; padding: 0 16px; line-height: 1;">
                Ver carrito
            </a>
            @if ($carritoData->isNotEmpty())
                <a href="{{ route('checkout') }}"
                    class="btn text-white fw-semibold rounded-3 shadow-sm d-flex align-items-center justify-content-center"
                    style="background-color:  #8f5b11; height: 42px; padding: 0 16px; line-height: 1;">
                    Pagar
                </a>
            @endif
        </div>

    </div>
</div>
