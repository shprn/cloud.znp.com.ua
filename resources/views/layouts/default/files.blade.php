@foreach($files as $elem)
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 p-0">
        <a class="thumb-container" href="{{ asset($elem->url) }}" title="{{ $elem->name }}" v-bind:class="activeFileId == 'File{{$loop->index}}' ? 'active' : ''">
            <div class="thumb">
                <img src="{{ $elem->urlImage }}" alt=" {{ $elem->name }}" width="100%"
                     id="File{{$loop->index}}"
                     data-name="{{ $elem->name }}"
                     v-on:click="setActiveFile">
            </div>
        </a>
    </div>
@endforeach

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

@push('scripts')
    <script>
        document.getElementById('files').onclick = function (event) {
        event.preventDefault();
        }

        // Gallery
        document.getElementById('files').ondblclick = function (event) {
        if (!event.target.src)
        return;

        event = event || window.event;
        var target = event.target || event.srcElement,
        link = target.src ? target.parentNode.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
        };
    </script>
@endpush