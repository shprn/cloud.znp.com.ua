@section("menubar")
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/logo.png') }}" height="30" alt="">
            Cloud
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach($disks as $cur_disk_name => $cur_disk)
                    <li class="nav-item {{ $cur_disk_name == $disk ? 'active' : ''}}">
                        <a class="nav-link" href="{{ $cur_disk['url-directory'] }}">{{ $cur_disk['title'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
@endsection