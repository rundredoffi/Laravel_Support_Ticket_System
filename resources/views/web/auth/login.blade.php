@extends('layouts.guest')

@section('title')
    {{ __('Connexion') }}
@endsection

@section('content')
    <x-auth-card header="{{ __('Connexion') }}">
        <form class="user" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-user @error('email') is-invalid @enderror"
                        id="email" placeholder="{{ __('Entrez votre adresse email') }}" required autofocus>
                <x-validation-error input="email"/>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                        id="password" placeholder="{{ __('Entrez votre mot de passe') }}" required>
                <x-validation-error input="password"/>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Se connecter') }}
            </button>
        </form>

        <hr>

        <div class="text-center">
            <a class="small" href="{{ route('password.request') }}">{{ __('Mot de passe oublié ?') }}</a>
        </div>

        <div class="text-center">
            <a class="small" href="{{ route('register') }}">{{ __('Créez un nouveau compte !') }}</a>
        </div>
    </x-auth-card>
@endsection
