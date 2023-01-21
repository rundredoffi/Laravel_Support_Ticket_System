@props([
    'date',
    'showDate' => false,
])

{{ $date->diffForHumans() }}
@if ($showDate)
    <small>
        ({{ $date->format('d.m.Y - H:i T') }})
    </small>
@endif