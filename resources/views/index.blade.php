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
                    <div class="row">
                        @include("layouts.default.folders")
                    </div>
                    <div class="row" id="links">
                        @include("layouts.default.files")
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
