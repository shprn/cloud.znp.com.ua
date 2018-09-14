@if(Disk::currentName())
    <div class="sidebar position-fixed full-height p-3" style="z-index: 1000;">

        <!-- Button-Forms -->
        @if(isset($forms))
            @foreach($forms as $form => $data)
                @include("layouts.default.$form", $data)
            @endforeach
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

        <ul class="list-unstyled fixed-bottom m-3 mb-4">
            <li v-for="property in activeFile">
                <b>@{{ property.name }}</b>: <span>@{{property.value}}</span>
            </li>
        </ul>
    </div>
    <div class="sidebar"></div>
@endif