<button class="form-control btn btn-primary" data-toggle="collapse" data-target="#nameDirectoryContent">+ Новый каталог</i></button>

<form action="{{ asset(Request::route('disk').'/createDirectory/'.Request::route('path')) }}" method="POST">
    @csrf
    <div class="form-group mt-1">
        <div class="input-group collapse" id="nameDirectoryContent">

            @if(isset($newNameDirectoryOptions))
                <select class="custom-select" id="nameDirectory" name="nameDirectory">
                    @foreach($newNameDirectoryOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" name="nameDirectory" value="{{ isset($newNameDirectory) ? $newNameDirectory : '' }}" class="form-control{{ $errors->has('nameDirectory') ? ' is-invalid' : '' }}" placeholder="Имя">
            @endif

            <div class="input-group-append">
                <button type="submit" class="form-control btn btn-outline-secondary" id="submitCreateDirectoryControl"><i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>

</form>
