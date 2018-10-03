@extends("layouts.default")

@section("main")
    <div class="container-fluid" id="app">
        <div class="row">
            @include("layouts.default.sidebar")

            <div class="col">
                <div class="container-fluid">
                    <div class="row">
                        @include("layouts.default.breadcrumb")
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row align-items-center justify-content-center full-height" v-if="!readyFolders || !readyFiles">
                        <img src = "{{ asset('img/loading2.gif') }}">
                    </div>
                    <div class="row" id="directories">
                        @include("layouts.default.folders")
                    </div>
                    <div class="row" id="files">
                        @include("layouts.default.files")
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
