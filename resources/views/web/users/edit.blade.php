@extends('layouts.app', [
    'title' => __('Edit User') . ' - ' . $user->id,
    'columnSize' => 'col-lg-8',
])

@section('content')
    <x-errors/>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PATCH')

        <div class="form-group mb-3">
            <label for="first_name">{{ __('Prénom') }}</label>
            <input type="text" name="first_name" class="form-control" id="first_name"
                    value="{{ old('first_name', $user->first_name) }}" minlength="3" maxlength="60" required>
        </div>

        <div class="form-group mb-3">
            <label for="last_name">{{ __('Nom de famille') }}</label>
            <input type="text" name="last_name" class="form-control" id="last_name"
                    value="{{ old('last_name', $user->last_name) }}" minlength="3" maxlength="60" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" class="form-control" id="email"
                    value="{{ old('email', $user->email) }}" maxlength="255" required>
        </div>

        @can ('changeRole', $user)
            <div class="form-group mb-3">
                <label for="role">{{ __('Role') }}</label>
                <x-users.role-list :user="$user" name="role" required/>
            </div>
        @endcan

        <button type="submit" class="btn btn-primary btn-block">{{ __('Sauvegarder') }}</button>
    </form>
@endsection
