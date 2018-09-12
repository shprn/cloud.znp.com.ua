@section("sidebar")

    <div class="col-12 sidebar" style="z-index: 1000;">

        <!-- Button-Forms -->
        @if(Disk::current())
            @if(isset($forms))
                @foreach($forms as $form)
                    @include("layouts.default.$form")
                @endforeach
            @endif
        @endif

        <!-- Links -->
        @if(isset($links))
            <ul class="nav flex-column mt-3">
                @foreach($links as $title => $link)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $link }}">{{ $title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

@endsection