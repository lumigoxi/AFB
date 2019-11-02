@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Iniciar Sesión</div>
                @if( session('status'))
                    <div class="alert alert-danger">{{ session('status') }}</div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="formLogin">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-1">
                        <div class="col text-center">
                            <div class = "g-recaptcha" id="LoginRecaptcha" 
                                data-sitekey = "{{env ('GOOGLE_RECAPTCHA_KEY')}}"> 
                            </div>
                            <div id="g-recaptcha-error" class="my-3"></div>
                        </div>
                    </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    Iniciar
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        ¿Olvidates tu contraseña?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('#formLogin').on('submit', function(e){
        let captcha = grecaptcha.getResponse()
        if (captcha.length == 0) {
            e.preventDefault()
            document.getElementById('g-recaptcha-error').innerHTML = '<span class="alert alert-danger">Debes completar el reCaptcha</span>';
            $("#g-recaptcha-error span").delay(1000).fadeOut(2000, function() { $(this).remove(); })
        }
    })
</script>
@endsection
