{{-- @if(count($folders)) --}}
    {{-- @foreach($folders as $elem) --}}
    <template v-for="(elem, index) in folders">
        <div class="col-xl-1 col-lg-2 col-md-3 col-6 mb-2 p-0">
            <a class="thumb-container"
               v-bind:href="elem.url"
               v-bind:class="activeDirectoryIndex == index ? 'active' : ''">
                <div class="thumb">
                    <img v-bind:src="elem.empty ? '{{asset('img/empty_folder.png')}}' : '{{ asset('img/folder.png')}}'"
                         v-bind:data-index="index"
                         v-bind:title="elem.name" width="100%"
                         v-on:click="setActiveDirectory">
                    <!--h6 class="img-title">@{{ elem.name }} @{{ elem.empty ? " (пусто)" : "" }}</h6-->
                    <h6 class="img-title">@{{ elem.name }} @{{ elem.empty ? " (пусто)" : "" }}</h6>
                </div>
            </a>
        </div>
    </template>
    {{-- @endforeach --}}
{{-- @endif --}}
