{{-- @foreach($files as $elem) --}}
<template v-for="(elem, index) in files">
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 p-0">
        <a class="thumb-container"
           v-bind:href="elem.url"
           v-bind:title="elem.name"
           v-bind:class="activeFileIndex == index ? 'active' : ''">
            <div class="thumb">
                <img v-bind:src="elem.urlImage"
                     v-bind:alt="elem.name"
                     width="100%"
                     v-bind:data-index="index"
                     v-bind:data-name="elem.name"
                     v-on:click="setActiveFile">
            </div>
        </a>
    </div>
</template>

{{-- @endforeach --}}

<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close blueimp-control">×</a>
    <a class="play-pause"></a>
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