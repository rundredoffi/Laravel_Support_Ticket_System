@switch($user->role)
    @case(\App\Models\User::REGULAR_USER)
        <small>
            <span class="badge badge-pill badge-success">{{ __('User') }}</span>
        </small>
        @break

    @case(\App\Models\User::AGENT)
        <small>
            <span class="badge badge-pill badge-info">{{ __('Agent') }}</span>
        </small>
        @break

    @case(\App\Models\User::ADMINISTRATOR)
        <small>
            <span class="badge badge-pill badge-danger">{{ __('Administrator') }}</span>
        </small>
        @break

    @default
        <small>
            <span class="badge badge-pill badge-secondary">{{ __('Unknown') }}</span>
        </small>
@endswitch

