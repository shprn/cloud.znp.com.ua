<button class="form-control btn btn-primary" id="btnFolder">+ Новый каталог</i></button>

<form action="{{ asset(Request::route('disk').'/createDirectory/'.Request::route('path')) }}" method="POST">
    @csrf
    <div class="form-group mt-1">
        <div class="input-group" id="nameDirectoryContent" hidden>

            @if(isset($newNameDirectoryOptions))
                <select class="custom-select" id="nameDirectory" name="nameDirectory">
                    @foreach($newNameDirectoryOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" id="nameDirectory" name="nameDirectory" value="{{ isset($newNameDirectory) ? $newNameDirectory : '' }}" class="form-control{{ $errors->has('nameDirectory') ? ' is-invalid' : '' }}" placeholder="Имя">
            @endif

            <div class="input-group-append">
                <button type="submit" class="form-control btn btn-outline-secondary" id="submitCreateDirectoryControl"><i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>

</form>

@push('scripts')
    <script>
        $('#btnFolder').on('click', function(e) {
            $('#nameDirectoryContent').removeAttr('hidden');
            $('#nameDirectory').focus();
        });

        $('#nameDirectory').on('blur', function(e) {
            $('#nameDirectoryContent').attr('hidden', 'hidden');
        });
    </script>
@endpush