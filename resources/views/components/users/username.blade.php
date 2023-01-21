@props([
    'user' => null,
    'withRole' => false,
])

@if ($user)
    {{ $user->full_name }}

    @if ($withRole)
        <x-users.role-badge :user="$user"/>
    @endif
@else
    <em>{{ __('Not specified') }}</em>
@endif