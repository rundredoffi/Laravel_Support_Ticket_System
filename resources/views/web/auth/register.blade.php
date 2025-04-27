@extends('layouts.guest')

@section('title')
    {{ __('Register') }}
@endsection

@section('content')
    <x-auth-card header="Create an account">
        <form class="user" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="text" name="first_name" class="form-control form-control-user @error('first_name') is-invalid @enderror" id="first_name"
                        placeholder="{{ __('Prénom') }}" value="{{ old('first_name') }}" minlength="3" maxlength="60" autofocus required>
                <x-validation-error input="first_name"/>
            </div>

            <div class="form-group">
                <input type="text" name="last_name" class="form-control form-control-user @error('last_name') is-invalid @enderror" id="last_name"
                        placeholder="{{ __('Nom de famille') }}" value="{{ old('last_name') }}" minlength="3" maxlength="60" required>
                <x-validation-error input="last_name"/>
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                        placeholder="{{ __('Addresse email') }}" value="{{ old('email') }}" maxlength="255" required>
                <x-validation-error input="email"/>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                            id="password" placeholder="{{ __('Mot de passe') }}" minlength="8" maxlength="255" required>
                    <x-validation-error input="password"/>
                </div>

                <div class="col-sm-6">
                    <input type="password" name="password_confirmation" class="form-control form-control-user"
                            id="password_confirmation" placeholder="{{ __('Répeter votre mot de passe') }}" minlength="8" maxlength="255" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Créer votre compte') }}
            </button>
        </form>

        <hr>

        <div class="text-center">
            <a class="small" href="{{ route('password.request') }}">{{ __('Mot de passe oublié ?') }}</a>
        </div>

        <div class="text-center">
            <a class="small" href="{{ route('login') }}">{{ __('Vous avez déjà un compte ? Connectez-vous !') }}</a>
        </div>
    </x-auth-card>
@endsection
