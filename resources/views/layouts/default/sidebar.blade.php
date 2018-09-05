@section("sidebar")
    @if(isset($disk))
        {!! Form::open(['url' => Request::route('disk')."/uploadFile", 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'uploadform']) !!}
            <div class="form-control btn btn-primary upload-form">
                Добавить файлы
                {!! Form::file('', ['class' => 'form-control-file', 'name' => 'files[]', 'required', 'multiple', 'onchange' => "document.getElementById('uploadform').submit()"]) !!}
            </div>
            {!! Form::submit('Отправить', ['id' => 'submitControl', 'class' => 'form-control btn btn-primary', 'hidden']) !!}
        {!! Form::close() !!}

        @if ($disk == "gas-arrival")
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ asset(Request::route('disk').'/today') }}">Сегодня</a>
            </li>
        </ul>
        @endif
    @endif
@endsection