@extends('layouts.guest')

@section('title')
    {{ __('Forgotten Password') }}
@endsection

@section('content')
    <x-auth-card header="Forgot your password?">
        <p class="mb-4 text-center">
            {{ __('We get it, stuff happens. Just enter your email address below and we will send you a link to reset your password!') }}
        </p>

        <form class="user" action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-user @error('email') is-invalid @enderror"
                        id="email" placeholder="{{ __('Enter your email address') }}" autofocus required>
                <x-validation-error input="email"/>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Reset My Password') }}
            </button>
        </form>

        <hr>

        <div class="text-center">
            <a class="small" href="{{ route('login') }}">{{ __('Do you remember your password? Log In!') }}</a>
        </div>
    </x-auth-card>
@endsection
