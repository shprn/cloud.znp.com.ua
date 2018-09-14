@if(isset($breadcrumbs))
    @if(count($breadcrumbs) > 0)
        <div class="col-12">
            <ol class="breadcrumb mb-2">
                @foreach($breadcrumbs as $elem)
                    @if($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">{{ $elem['title'] }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ asset($elem['url']) }}">{{ $elem['title'] }}</a></li>
                    @endif
                @endforeach
            </ol>
        </div>
    @endif
@endif