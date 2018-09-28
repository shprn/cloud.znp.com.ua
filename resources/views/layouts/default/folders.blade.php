@if(count($folders))
    @foreach($folders as $elem)
        <div class="col-xl-1 col-lg-2 col-md-3 col-6 mb-2 p-0">
            <a class="thumb-container" href="{{ $elem->url }}" v-bind:class="activeDirectoryId == {{$loop->index}} ? 'active' : ''">
                <div class="thumb">
                    <img id="{{$loop->index}}" src="{{ $elem->empty ? asset('img/empty_folder.png') : asset('img/folder.png') }}" alt=" {{ $elem->name }}" title="{{ $elem->name }}" width="100%" v-on:click="setActiveDirectory">
                    <h6 class="img-title">{{ $elem->name . ($elem->empty ? " (пусто)" : "")}}</h6>
                </div>
            </a>
        </div>
    @endforeach
@endif
