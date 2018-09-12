@include("layouts.default.menubar")
@include("layouts.default.sidebar")
@include("layouts.default.navbar")

<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name = "csrf-token" content = "{{ csrf_token() }}">

    <title>Cloud</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css?ver=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css?ver=1.0.1') }}">
    <link rel="stylesheet" href="{{ asset('css/blueimp-gallery.min.css?ver=2.33.0') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
    <!-- Main menu -->
    @yield("menubar")

    <div class="container-fluid" id="app">
        <div class="row">
            <!-- Left sidebar-->
            @yield("sidebar")

            <!-- Main work area -->
            <div class="col">
                @yield('navbar')
                @yield('main')
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/app.js?ver=1.0.0') }}"></script>
    <script src="{{ asset('js/blueimp-gallery.js?ver=2.33.0') }}"></script>
    <script src="{{ asset('js/my.js?ver=1.0.0') }}"></script>
</body>
</html>
