@extends("layouts.default")

@include("layouts.default.folders")
@include("layouts.default.files")

@section("main")
    <div class="container-fluid">

        @yield("folders")

        @yield("files")

    </div>
@endsection