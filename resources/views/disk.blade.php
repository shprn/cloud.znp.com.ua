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
                       <img src="{{ $params['empty'] ? asset('img/empty_folder.png') : asset('img/folder.png') }}" alt=" {{ $path }}" title="{{ $path }}" width="100%">
                       <h6 class="img-title">{{ $params['name'] . ($params['empty'] ? " (пусто)" : "")}}</h6>
                   </div>
               </a>
            </div>
            @endforeach
        </div>

        <div class="row" id="links">
            @foreach($files as $path => $params)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 p-0">
                <div class="thumb-container">
                    <a class="thumb" href="{{ asset($params['url']) }}" title="{{ $path }}" onclick="return false;">
                        <img src="{{ $params['url_image'] }}" alt=" {{ $path }}" title="{{ $path }}" width="100%">
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides" href="#"></div>
            <h3 class="title"></h3>
            <a class="prev" href="#">‹</a>
            <a class="next" href="#">›</a>
            <a class="close blueimp-control" href="#">×</a>
            <a class="play-pause" href="#"></a>
            <ol class="indicator"></ol>
        </div>

    </div>
@endsection