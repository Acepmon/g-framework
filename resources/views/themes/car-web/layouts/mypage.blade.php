<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('car-web/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <!-- Owl Carousel core CSS -->
        <link href="{{ asset('car-web/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('car-web/vendor/owl.carousel/assets/owl.theme.default.css') }}" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="{{ asset('car-web/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('car-web/css/car-icons/style.css') }}" rel="stylesheet">
        <link href="{{ asset('car-web/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css">

        <!-- Animation style for this template -->
        <link href="{{ asset('car-web/css/animate.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('car-web/css/style.min.css') }}" rel="stylesheet">

        <!-- /global stylesheets -->

        @yield('load')

        @stack('styles')
    </head>

    <body>

        <!-- Header -->
        @include('themes.car-web.includes.header')

        <div class="bg-page-header"></div>

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        @include('themes.car-web.includes.profile')

                        <div class="card shadow-soft-blue my-page-left">
                            <ul class="list-group list-group-flush">
                                @foreach (\App\Menu::where('title', 'Car Profile Dropdown')->first()->children as $menu)
                                    <li class="list-group-item {{ Request::is(\Str::startsWith($menu->link, '/') ? substr($menu->link, 1) : $menu->link) ? 'active' : '' }}"><a href="{{ url($menu->link) }}">{{ $menu->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- left bar end -->
                    <div class="col-md-8 col-lg-9">
                        @yield('content')
                    </div>
                    <!-- car list end -->
                </div>
                <!-- row end -->
            </div>
            <!-- container end -->
        </section>

         <!-- Footer -->
        @include('themes.car-web.includes.footer')

        @stack('modals')

        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('car-web/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('car-web/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('car-web/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('car-web/vendor/owl.carousel.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
        <script src="{{ asset('car-web/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('car-web/vendor/lottie-web/player/lottie.min.js') }}"></script>
        <script src="{{ asset('car-web/js/script.min.js') }}"></script>
        @yield('script')

        @stack('scripts')
    </body>

</html>
