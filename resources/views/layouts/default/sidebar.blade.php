@if(Disk::currentName())
<div class="col-12 sidebar">
    <div class="sidebar-content" style="z-index: 1000;">

        <!-- Button-Forms -->
        @if(isset($forms))
            @foreach($forms as $form => $data)
                @include("layouts.default.$form", $data)
            @endforeach
        @endif


        <!-- Links -->
        @if(isset($links))
            <ul class="nav flex-column d-none d-md-block mt-3">
                @foreach($links as $title => $link)
                <li class="nav-item">
                    <a class="nav-link" href="{{ $link }}">{{ $title }}</a>
                </li>
                @endforeach
            </ul>
        @endif

        <template v-if="activeFileId != -1">
            <div class="card mt-3">
                <div class="card-header text-center">Свойства файла</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li v-for="property in propertiesActiveFile">
                            <b>@{{ property.name }}</b>: <span>@{{property.value}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </template>
    </div>
</div>
@endif