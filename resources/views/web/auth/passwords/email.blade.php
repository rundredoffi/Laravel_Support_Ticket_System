@extends('layouts.guest')

@section('title')
    {{ __('Mot de passe oublié') }}
@endsection

@section('content')
    <x-auth-card header="Mot de passe oublié?">
        <p class="mb-4 text-center">
            {{ __('Nous comprenons, cela arrive. Entrez simplement votre adresse e-mail ci-dessous et nous vous enverrons un lien pour réinitialiser votre mot de passe !') }}
        </p>

        <form class="user" action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-user @error('email') is-invalid @enderror"
                        id="email" placeholder="{{ __('Entrez votre adresse email') }}" autofocus required>
                <x-validation-error input="email"/>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Réinitialiser mon mot de passe') }}
            </button>
        </form>

        <hr>

        <div class="text-center">
            <a class="small" href="{{ route('login') }}">{{ __('Vous vous souvenez de votre mot de passe ? Connectez-vous !') }}</a>
        </div>
    </x-auth-card>
@endsection
