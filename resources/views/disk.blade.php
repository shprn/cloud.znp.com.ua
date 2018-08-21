@extends("layouts.default")
@extends("layouts.default.menubar")
@extends("layouts.default.sidebar")
@extends("layouts.default.navbar")

@section("main")
    <div class="container-fluid">
        <div class="row">
            @foreach($directories as $path => $params)
            <div class="col-xl-1 col-lg-2 col-md-3 col-4 mb-4 p-0">
               <a class="thumb-container" href="{{ ($params['url']) }}">
                   <div class="thumb">
                       <img class="img-fluid" src="{{ $params['empty'] ? asset('img/empty_folder.png') : asset('img/folder.png') }}" alt=" {{ $path }}" title="{{ $path}}">
                       <h6 class="img-title">{{ $params['name'] . ($params['empty'] ? " (пусто)" : "")}}</h6>
                   </div>
               </a>
            </div>
            @endforeach

            @foreach($files as $path => $params)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6 p-0">
                <a class="thumb-container" href="{{ asset($params['url']) }}">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ $params['url_image'] }}" alt=" {{ $path}}" title="{{ $path}}">
                    </div>
                </a>
            </div>
            @endforeach

        </a>
    </div>
@endsection