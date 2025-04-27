<table class="table table-bordered text-center">
    <thead class="thead-light">
        <tr>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Description') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($logs as $log)
            <tr>
                <td>{{ $log->created_at->format('d.m.Y - H:i T') }}</td>
                <td>{{ __($log->description) }}</td>
            </tr>
        @empty
            <td colspan="2">{{ __('Impossible de retrouver le ticket') }}</td>
        @endforelse
    </tbody>
</table>