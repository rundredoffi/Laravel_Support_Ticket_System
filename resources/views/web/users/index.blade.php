@extends('layouts.app', ['title' => __('Utilisateurs')])

@section('content')
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Nom complet') }}</th>
                <th>{{ __('Rejoins le') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Rôle') }}</th>
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
                <td colspan="5">{{ __('Aucun utilisateur trouvé.') }}</td>
            @endforelse
        </tbody>
    </table>

    <x-pagination :collection="$users"/>
@endsection
