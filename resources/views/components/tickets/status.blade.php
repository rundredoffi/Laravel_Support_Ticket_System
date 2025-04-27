@if (empty($ticket->closed_at))
    <span class="badge badge-info">{{ __('Ouvert') }}
@else
    <span class="badge badge-danger">{{ __('Clôturé') }}
@endif