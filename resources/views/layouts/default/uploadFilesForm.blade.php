{!! Form::open(['url' => Request::route('disk')."/uploadFile", 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'uploadform']) !!}
    <div class="form-control btn btn-primary upload-form">
        Добавить файлы
        {!! Form::file('', ['class' => 'form-control-file', 'name' => 'files[]', 'required', 'multiple', 'onchange' => "document.getElementById('uploadform').submit()"]) !!}
    </div>
    {!! Form::submit('Отправить', ['id' => 'submitControl', 'class' => 'form-control btn btn-primary', 'hidden']) !!}
    {!! Form::text('disk', Request::route("disk"), ['hidden']) !!}
    {!! Form::text('path', Request::route("path"), ['hidden']) !!}
{!! Form::close() !!}
