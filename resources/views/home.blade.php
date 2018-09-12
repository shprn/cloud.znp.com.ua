@extends("layouts.default")

@section("sidebar")
@endsection

@section("main")
@guest
    <div class="jumbotron">
        <h1 class="display-4">
            <img src = "{{ asset('img/logo.png') }}" height="80px">
            Cloud
        </h1>
        <p class="lead">Авторизуйтесь для получения доступа к содержимому</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href=" {{ route('login') }}" role="button">Вход</a>
    </div>
@endguest
@endsection