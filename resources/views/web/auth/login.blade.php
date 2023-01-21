@extends('layouts.guest')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
    <x-auth-card header="{{ __('Log In') }}">
        <form class="user" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-user @error('email') is-invalid @enderror"
                        id="email" placeholder="{{ __('Enter your email address') }}" required autofocus>
                <x-validation-error input="email"/>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                        id="password" placeholder="{{ __('Enter your password') }}" required>
                <x-validation-error input="password"/>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Log In') }}
            </button>
        </form>

        <hr>

        <div class="text-center">
            <a class="small" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
        </div>

        <div class="text-center">
            <a class="small" href="{{ route('register') }}">{{ __('Create a new account!') }}</a>
        </div>
    </x-auth-card>
@endsection
