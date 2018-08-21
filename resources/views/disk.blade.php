@extends("layouts.default")
@extends("layouts.default.menubar")
@extends("layouts.default.sidebar")
@extends("layouts.default.navbar")

@section("main")
    <div class="container-fluid">
    <div class="row">
        @foreach($directories as $path => $params)
        <a class="col-xl-1 col-lg-2 col-md-3 col-4 mb-4 p-1" href="{{ ($params['url']) }}">
            <div class="card">
                <img class="card-img-top" src="{{ $params['empty'] ? asset('img/empty_folder.png') : asset('img/folder.png') }}" alt=" {{ $path }}" title="{{ $path}}">
                <h6 class="card-title text-center">{{ $params['name'] . ($params['empty'] ? " (пусто)" : "")}}</h6>
            </div>
        </a>
        @endforeach

        @foreach($files as $path => $params)
            <a class="col-xl-2 col-lg-3 col-md-4 col-6 thumb" href="{{ asset($params['url']) }}">
                <img class="img-fluid" src="{{ $params['url_image'] }}" alt=" {{ $path}}" title="{{ $path}}">
                <!-- span class="img-title">{{ basename($path) }}</span -->
            </a>
        @endforeach

    </div>
@endsection