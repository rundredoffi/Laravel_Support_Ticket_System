@extends('layouts.app', ['title' => __('Priorities')])

@section('content')
    <x-errors/>

    @can ('create', \App\Models\Priority::class)
        <a href="{{ route('priorities.create') }}" class="btn btn-primary mb-3">
            {{ __('Create a priority') }}
        </a>
    @endcan

    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Created on') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($priorities as $priority)
                <tr>
                    <td>
                        {{ $priority->id }}
                    </td>
                    <td>
                        @can ('update', $priority)
                            <a href="{{ route('priorities.edit', $priority) }}">
                                {{ $priority->name }}
                            </a>
                        @else
                            {{ $priority->name }}
                        @endcan
                    </td>
                    <td>
                        <x-datetime :date="$priority->created_at"/>
                    </td>
                </tr>
            @empty
                <td colspan="3">
                    {{ __('No priorities have been created yet.') }}
                </td>
            @endforelse
        </tbody>
    </table>

    <x-pagination :collection="$priorities"/>
@endsection
