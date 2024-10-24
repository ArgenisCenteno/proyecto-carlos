<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>{{ config('app.name', 'FRIONAX') }}</title>

    <!-- Fonts -->
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

        body {
            font-family: "Roboto" !important;
        }

        /*--------------------------------------------------------------
# Global Footer
--------------------------------------------------------------*/
        .footer {
            color: var(--default-color);
            background-color: var(--background-color);
            font-size: 14px;
            padding-bottom: 50px;
            position: relative;
        }

        .footer .footer-newsletter {
            background-color: color-mix(in srgb, var(--heading-color), transparent 95%);
            padding: 50px 0;
        }

        .footer .footer-newsletter h4 {
            font-size: 24px;
        }

        .footer .footer-newsletter .newsletter-form {
            margin-top: 30px;
            margin-bottom: 15px;
            padding: 6px 8px;
            position: relative;
            background-color: color-mix(in srgb, var(--background-color), transparent 50%);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1);
            display: flex;
            transition: 0.3s;
            border-radius: 50px;
        }

        .footer .footer-newsletter .newsletter-form:focus-within {
            border-color: var(--accent-color);
        }

        .footer .footer-newsletter .newsletter-form input[type=email] {
            border: 0;
            padding: 4px;
            width: 100%;
            background-color: color-mix(in srgb, var(--background-color), transparent 50%);
            color: var(--default-color);
        }

        .footer .footer-newsletter .newsletter-form input[type=email]:focus-visible {
            outline: none;
        }

        .footer .footer-newsletter .newsletter-form input[type=submit] {
            border: 0;
            font-size: 16px;
            padding: 0 20px;
            margin: -7px -8px -7px 0;
            background: var(--accent-color);
            color: var(--contrast-color);
            transition: 0.3s;
            border-radius: 50px;
        }

        .footer .footer-newsletter .newsletter-form input[type=submit]:hover {
            background: color-mix(in srgb, var(--accent-color), transparent 20%);
        }

        .footer .footer-top {
            padding-top: 50px;
        }

        .footer .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 50%);
            font-size: 16px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin-right: 10px;
            transition: 0.3s;
        }

        .footer .social-links a:hover {
            color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .footer h4 {
            font-size: 16px;
            font-weight: bold;
            position: relative;
            padding-bottom: 12px;
        }

        .footer .footer-links {
            margin-bottom: 30px;
        }

        .footer .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer .footer-links ul i {
            margin-right: 3px;
            font-size: 12px;
            line-height: 0;
            color: var(--accent-color);
        }

        .footer .footer-links ul li {
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        .footer .footer-links ul li:first-child {
            padding-top: 0;
        }

        .footer .footer-links ul a {
            display: inline-block;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            line-height: 1;
        }

        .footer .footer-links ul a:hover {
            color: var(--accent-color);
        }

        .footer .footer-about a {
            color: var(--heading-color);
            font-size: 28px;
            font-weight: 600;
            text-transform: uppercase;
            font-family: var(--heading-font);
        }

        .footer .footer-contact p {
            margin-bottom: 5px;
        }

        .footer .copyright {
            padding-top: 25px;
            padding-bottom: 25px;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
        }

        .footer .copyright p {
            margin-bottom: 0;
        }

        .footer .credits {
            margin-top: 6px;
            font-size: 13px;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('layout.head')
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="{{ url('/') }}"> <strong class="navbar-brand text-white">FRIONAX</strong></a>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#services">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Ubicaciones</a>
                        </li>
                         
       <div class="nav-item">
       <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="material-icons">search</i>
        </button>
       </div>
     
                    </ul>
                    <div class="d-flex align-items-center">
                        <a class="text-reset me-3" href="#">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        <a href="{{ route('carrito.show') }}" class="text-white me-3">
                            Carrito
                        </a>
                        @auth
                            <a href="{{ route('home') }}" class="nav-link text-white me-3">
                                Mi perfil
                            </a>
                            <a href="{{ route('logout') }}" class="nav-link text-white "
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white">Ingresar</a>
                        @endauth


                    </div>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @foreach($categorias as $categoria)
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('productosPorCategoria', $categoria->id) }}">{{ $categoria->nombre }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </nav>
        <!-- Navbar -->

        <main class="">
            @yield('content')
        </main>
    </div> 
     <!-- Modal de búsqueda -->
     <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('buscar')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Buscar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="query" id="searchProduct" placeholder="Escriba el nombre del producto">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" >Buscar</button>
                </div>
            </div>
            </form>
           
        </div>
    </div>

    <footer id="footer" class="footer" style="margin-top: 220px !important;">



        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">FRIONAX</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Calle Andres Bello</p>
                        <p>Punta de Mata</p>
                        <p class="mt-3"><strong>Telefono:</strong> <span>04148079255</span></p>
                        <p><strong>Email:</strong> <span>atencionalcliente@frionax.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Principal</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About </a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Servicios</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terminos y Condiciones</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Nuestros servicios</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Repuestos</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Mantenimiento</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Refrigeración</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Electricidad</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>¡Síguenos en nuestras redes!</h4>

                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Frionax</strong> <span>All Rights Reserved</span>
            </p>

        </div>

    </footer>
</body>
@yield('js')
@include('layout.script')
@include('sweetalert::alert')
@include('layout.datatables_css')
@include('layout.datatables_js')
<script>
        function buscarProducto() {
            const producto = document.getElementById('searchProduct').value;
            if (producto) {
                // Aquí iría la lógica para buscar el producto (puede ser una solicitud AJAX).
                alert('Buscando el producto: ' + producto);
            } else {
                alert('Por favor, ingrese un nombre de producto.');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>