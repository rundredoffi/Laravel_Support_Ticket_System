@extends('layouts.guest')

@section('title')
    {{ __('Confirm Password') }}
@endsection

@section('content')
    <x-auth-card header="Confirm Password">
        <p class="mb-4 text-center">
            {{ __('Please confirm your password before continuing.') }}
        </p>

        <form class="user" action="{{ route('password.confirm') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                        id="password" placeholder="{{ __('Enter your password') }}" autofocus required>
                <x-validation-error input="password"/>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Confirm Password') }}
            </button>
        </form>

        <hr>

        <div class="text-center">
            <a class="small" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
        </div>
    </x-auth-card>
@endsection
