@if (empty($ticket->closed_at))
    <span class="badge badge-info">{{ __('Open') }}
@else
    <span class="badge badge-danger">{{ __('Closed') }}
@endif