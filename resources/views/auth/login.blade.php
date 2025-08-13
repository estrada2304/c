@extends('layouts.app')

@section('content')
<div class="login-container" style="background-image: url('/images/antena-background.jpg');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-box">
                    <!-- Logo y Nombre de la Empresa -->
                    <div class="text-center mb-4">
                        <div class="company-name">ROTOPOOL</div>
                        <h2 class="text-green">Iniciar Sesión</h2>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Recordar sesión -->
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Recordar sesión') }}
                                </label>
                            </div>
                        </div>

                        <!-- Botón de Login -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-login w-100">
                                {{ __('Ingresar') }}
                            </button>
                        </div>

                        <!-- Olvidé mi contraseña -->
                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="text-green" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos personalizados */
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .login-box {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .company-name {
        color: #2ecc71; /* Verde Kaitoke */
        font-weight: bold;
        font-size: 2.5rem;
        margin-bottom: 10px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .text-green {
        color: #2ecc71;
    }

    .btn-login {
        background-color: #2ecc71;
        color: white;
        border: none;
        padding: 10px;
        font-weight: 600;
    }

    .btn-login:hover {
        background-color: #27ae60;
    }

    .form-control:focus {
        border-color: #2ecc71;
        box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.25);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-box {
            padding: 20px;
        }
        .company-name {
            font-size: 2rem;
        }
    }
</style>
@endsection