@foreach($files as $elem)
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 p-0">
        <div class="thumb-container">
            <a class="thumb" href="{{ asset($elem->url) }}" title="{{ $elem->name }}" onclick="return false;">
                <img src="{{ $elem->urlImage }}" alt=" {{ $elem->name }}" width="100%"
                     data-name="{{$elem->name}}"
                     data-date-time-original="{{ isset($elem->infoImage['DateTimeOriginal']) ? $elem->infoImage['DateTimeOriginal'] : '' }}"
                     data-model="{{ isset($elem->infoImage['Model']) ? $elem->infoImage['Model'] : '' }}"
                     v-on:click="setActiveFile">
            </a>
        </div>
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
