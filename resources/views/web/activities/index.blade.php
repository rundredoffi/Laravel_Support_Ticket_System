@extends('layouts.app', [
    'title' => __('Activities')
])

@section('content')
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>{{ __('Timestamp UTC') }}</th>
                <th>{{ __('Log name') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Subject type') }}</th>
                <th>{{ __('Subject ID') }}</th>
                <th>{{ __('Caused by') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($activities as $activity)
                <tr>
                    <td>
                        {{ $activity->created_at }}
                    </td>
                    <td>
                        {{ $activity->log_name }}
                    </td>
                    <td>
                        {{ $activity->description }}
                    </td>
                    <td>
                        {{ $activity->subject_type }}
                    </td>
                    <td>
                        {{ $activity->subject_id }}
                    </td>
                    <td>
                        <x-users.username :user="$activity->causer" withRole/>
                    </td>
                </tr>
            @empty
                <td colspan="6">{{ __('No activities have been found.') }}</td>
            @endforelse
        </tbody>
    </table>

    <x-pagination :collection="$activities"/>
@endsection
