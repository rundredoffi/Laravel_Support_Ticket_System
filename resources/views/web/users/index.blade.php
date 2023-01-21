@extends('layouts.app', ['title' => __('Users')])

@section('content')
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Full Name') }}</th>
                <th>{{ __('Joined at') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Role') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}">
                            {{ $user->full_name }}
                        </a>
                    </td>
                    <td>
                        <x-datetime :date="$user->created_at" showDate/>
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        <x-users.role-badge :user="$user"/>
                    </td>
                </tr>
            @empty
                <td colspan="5">{{ __('No users have been found.') }}</td>
            @endforelse
        </tbody>
    </table>

    <x-pagination :collection="$users"/>
@endsection
