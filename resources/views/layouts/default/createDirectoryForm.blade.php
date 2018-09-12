{!! Form::open(['url' => Request::route('disk')."/createDirectory", 'method' => 'POST', 'id' => 'create-directory']) !!}
    <div class="form-group">
        {!! Form::button('+ Каталог', ['class' => 'form-control btn btn-primary', 'onclick' => "$('#nameDirectoryGroup').toggle()"]) !!}
        <div class="input-group" id="nameDirectoryGroup" style="display: none">
            {!! Form::text('nameDirectory', '', ['class' => "form-control". ($errors->has('nameDirectory') ? ' is-invalid' : ''), 'placeholder' => 'Имя']) !!}
            {!! Form::submit('Go', ['id' => 'submitCreateDirectoryControl', 'class' => 'form-control btn btn-success']) !!}
        </div>
    </div>
    {!! Form::text('disk', Request::route("disk"), ['hidden']) !!}
    {!! Form::text('path', Request::route("path"), ['hidden']) !!}
{!! Form::close() !!}
