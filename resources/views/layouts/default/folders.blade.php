@section("folders")

    @if(count($folders))
        <div class="row">

        @foreach($folders as $elem)
            <div class="col-xl-1 col-lg-2 col-md-3 col-4 mb-4 p-0">
                <a class="thumb-container" href="{{ $elem->url }}">
                    <div class="thumb">
                        <img src="{{ $elem->empty ? asset('img/empty_folder.png') : asset('img/folder.png') }}" alt=" {{ $elem->name }}" title="{{ $elem->name }}" width="100%">
                        <h6 class="img-title">{{ $elem->name . ($elem->empty ? " (пусто)" : "")}}</h6>
                    </div>
                </a>
            </div>
        @endforeach

        </div>
    @endif

@endsection