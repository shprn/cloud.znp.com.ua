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
    <link rel="stylesheet" href="{{ asset('css/styles.css?ver=1.0.0') }}">
</head>
<body>
    <!-- Main menu -->
    @yield("menubar")

    <div class="container-fluid offset-top" id="app">
        <div class="row">
            <!-- Left sidebar-->
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12" style="z-index: 1000;">
                @yield("sidebar")
            </div>


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
    <!--script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script-->
</body>
</html>
