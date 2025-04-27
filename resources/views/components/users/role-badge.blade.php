@switch($user->role)
    @case(\App\Models\User::REGULAR_USER)
        <small>
            <span class="badge badge-pill badge-success">{{ __('Utilisateurs') }}</span>
        </small>
        @break

    @case(\App\Models\User::AGENT)
        <small>
            <span class="badge badge-pill badge-info">{{ __('Support') }}</span>
        </small>
        @break

    @case(\App\Models\User::ADMINISTRATOR)
        <small>
            <span class="badge badge-pill badge-danger">{{ __('Administrateur') }}</span>
        </small>
        @break

    @default
        <small>
            <span class="badge badge-pill badge-secondary">{{ __('Inconnu') }}</span>
        </small>
@endswitch

