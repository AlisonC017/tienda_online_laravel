@extends('app')

@section('contenido')
    <div class="container-xxl py-5">
        <div class="container">

            <div class="section-title text-center">
                <h1 class="display-5 mb-5" style="font-family: 'Satisfy', cursive;">Contacto</h1>
            </div>

            <div class="row g-5">

                <!-- Información de contacto -->
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class=" bg-white border rounded shadow-sm p-4 h-100">
                        <h4 class="mb-4">¿Tenés dudas? Escribinos</h4>

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-map-marker-alt text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Dirección</h6>
                                <small class="text-muted">Siquirres, Limón, Costa Rica</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-phone-alt text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Teléfono</h6>
                                <small class="text-muted">+506 0000 0000</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-envelope text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Correo</h6>
                                <small class="text-muted">crikoStore.info@gmail.com</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded"
                                style="width: 50px; height: 50px;">
                                <i class="far fa-clock text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Horario</h6>
                                <small class="text-muted">Lunes - Sábado : 09.00 AM - 10.00 PM</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-white border rounded shadow-sm p-4">
                        <h4 class="mb-4">Envianos un mensaje</h4>

                        <form id="contact-form" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="contact-nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="contact-nombre" required>
                                    <div class="invalid-feedback">Ingresá tu nombre.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact-correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="contact-correo" required>
                                    <div class="invalid-feedback">Ingresá un correo válido.</div>
                                </div>
                                <div class="col-12">
                                    <label for="contact-asunto" class="form-label">Asunto</label>
                                    <input type="text" class="form-control" id="contact-asunto" required>
                                    <div class="invalid-feedback">Ingresá un asunto.</div>
                                </div>
                                <div class="col-12">
                                    <label for="contact-mensaje" class="form-label">Mensaje</label>
                                    <textarea class="form-control" id="contact-mensaje" rows="5" required></textarea>
                                    <div class="invalid-feedback">Escribí tu mensaje.</div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary py-2 px-4">
                                        Enviar mensaje <i class="fa fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascrip')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contact-form');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                const nombre = document.getElementById('contact-nombre').value.trim();
                const correo = document.getElementById('contact-correo').value.trim();
                const asunto = document.getElementById('contact-asunto').value.trim();
                const mensaje = document.getElementById('contact-mensaje').value.trim();

                const cuerpo = mensaje + '\n\n' + nombre + '\n' + correo;

                // Abre el cliente de correo del usuario con el mensaje ya armado
                window.location.href = 'mailto:crikoStore.info@gmail.com' +
                    '?subject=' + encodeURIComponent(asunto) +
                    '&body=' + encodeURIComponent(cuerpo);
            });
        });
    </script>
@endsection
