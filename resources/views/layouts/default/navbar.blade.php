@section("navbar")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb mb-2">
                    @foreach($links as $elem => $link)
                        @if($loop->last)
                            <li class="breadcrumb-item active" aria-current="page">{{ $elem }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ asset($link) }}">{{ $elem }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

@endsection