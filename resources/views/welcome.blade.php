<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                {{--<a class="navbar-brand" href="{{route('index.student')}}">Product</a>--}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{url('/contact')}}">contact us</a></li>
                        <li><a class="dropdown-item" href="{{url('/about')}}">About us</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>
                @yield("list")

                @yield("contactus")

                @yield("about")

        <!-- Footer -->
        <footer class="text-center text-white" style="background-color: #3f51b5">
            <!-- Section: Social -->
            <section class="text-center">
                <a href="" class="text-white me-4">
                <i class="fa fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                <i class="fa fa-twitter"></i>
                </a>
                <a href="" class="text-white me-4">
                <i class="fa fa-google"></i>
                </a>
                <a href="" class="text-white me-4">
                <i class="fa fa-instagram"></i>
                </a>
                <a href="" class="text-white me-4">
                <i class="fa fa-linkedin"></i>
                </a>
                <a href="" class="text-white me-4">
                <i class="fa fa-github"></i>
                </a>
            </section>
            <!-- Section: Social -->

            <!-- Copyright -->
            <div
                class="text-center p-3"
                style="background-color: rgba(0, 0, 0, 0.2)"
                >
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/"
                >MDBootstrap.com</a
                >
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->


        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
