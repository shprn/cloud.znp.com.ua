@extends("layouts.default")

@section("main")
    <div class="container-fluid" id="app">
        <div class="row align-items-center justify-content-center full-height">
            <div class="p-3">
                <h1 class="display-4 text-center">
                    <img src = "{{ asset('img/logo.png') }}" height="80px">
                    Cloud
                </h1>
                @guest
                    <p class="lead">Авторизуйтесь для получения доступа к содержимому</p>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-lg" href=" {{ route('login') }}" role="button">Вход</a>
                @else
                <p class="lead text-center"><h4>Добрый день, {{ Auth::user()->name }}</h4></p>
                @endguest
            </div>
        </div>
    </div>
@endsection