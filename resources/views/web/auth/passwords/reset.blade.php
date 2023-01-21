@extends('layouts.guest')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    <x-auth-card header="Reset Password">
        <form class="user" action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                        placeholder="{{ __('Email Address') }}" value="{{ $email }}" maxlength="255" required>
                <x-validation-error input="email"/>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                        id="password" placeholder="{{ __('New Password') }}" minlength="8" maxlength="255" required>
                <x-validation-error input="password"/>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control form-control-user"
                        id="password_confirmation" placeholder="{{ __('Repeat New Password') }}" minlength="8" maxlength="255" required>
            </div>

            <br>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Reset My Password') }}
            </button>
        </form>
    </x-auth-card>
@endsection
