<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>CrikoStore - @yield('tittle')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="themes/admin/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    @include('layouts.tienda.css')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.tienda.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            @include('layouts.tienda.header')

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">@yield('titulo')</h3>
                            <h6 class="op-7 mb-2">@yield('subtitulo')</h6>
                        </div>
                    </div>
                    @yield('contenido')
                </div>
            </div>

            <!-- Footer -->
            @include('layouts.tienda.footer')
        </div>
    </div>
    @include('layouts.tienda.scripts')
</body>

</html>
