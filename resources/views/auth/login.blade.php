@extends("layouts.default")

@section('main')

<div class="container-fluid" id="app">
    <div class="row align-items-center justify-content-center half-height">
        <div class="p-3">

            <h1 class="display-4 text-center m-sm-5">
                <img src = "{{ asset('img/logo.png') }}" height="80px">
                Cloud
            </h1>

            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="Авторизация">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Запомнить меня
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="form-control btn btn-primary">
                                Войти
                            </button>

                            <div class="text-right">
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    <span class="small">Регистрация</span>
                                </a>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    <span class="small">Забыли пароль?</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        </div>
    </div>
</div>
@endsection
