<!-- PANEL LATERAL DESPLEGABLE (Pestañita) -->
<div class="offcanvas offcanvas-end p-3" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel"
    style="width: 380px;">

    <div class="offcanvas-header border-bottom pb-3">
        <div class="d-flex align-items-center gap-2">
            <h4 class="offcanvas-title fw-bold m-0" id="offcanvasCartLabel" style="color: #5a3707;">
                Carrito de Compras</h4>
            <span class="badge rounded-circle bg-warning text-white fs-6">3</span>
        </div>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between py-3">
        <div class="cart-list">
            <!-- Producto 1 -->
            <div class="d-flex justify-content-between align-items-start py-2 border-bottom">
                <div>
                    <h6 class="mb-0 fw-bold">Growers cider</h6>
                    <small class="text-muted">Brief description</small>
                </div>
                <span class="fw-bold text-secondary">$12</span>
            </div>

            <!-- Total -->
            <div class="d-flex justify-content-between align-items-center pt-3">
                <span class="text-muted fs-5">Total </span>
                <span class="fw-bold fs-5 text-dark">$20</span>
            </div>
        </div>

        <!-- Botón de Compra -->
        <div class="pt-3">
            <a href="checkout.html" class="btn text-white w-100 py-3 fw-bold rounded-3 fs-5 shadow-sm"
                style="background-color: #5a3707;">
                Pagar
            </a>
        </div>
    </div>
</div>
