@section("sidebar")
    <div class="card mb-0 mb-md-3 box-shadow">
        <div class="card-header text-center">
            Добавить новые файлы
        </div>
        <div class="card-body">
            {!! Form::open(['url' => Request::route('disk')."/uploadFile", 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group text-center">
                {!! Form::file('', ['class' => 'form-control-file upload-file', 'name' => 'files[]', 'required', 'multiple']) !!}
            </div>
            <div class="form-group text-center">
                {!! Form::text('description', "", ['class' => 'form-control', 'placeholder' => 'Описание']) !!}
            </div>
            {!! Form::submit('Отправить', ['class' => 'form-control btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    @if ($disk == "gas-arrival")
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ asset(Request::route('disk').'/today') }}">Сегодня</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ asset(Request::route('disk').'/todayHome') }}">Сегодня в домашней папке</a>
        </li>
    </ul>
    @endif

@endsection