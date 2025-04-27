@extends('layouts.app', ['title' => __('Priorités')])

@section('content')
    <x-errors/>

    @can ('create', \App\Models\Priority::class)
        <a href="{{ route('priorities.create') }}" class="btn btn-primary mb-3">
            {{ __('Créer une priorité') }}
        </a>
    @endcan

    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Nom') }}</th>
                <th>{{ __('Créée') }}</th>
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
                    {{ __('Aucune priorité existante') }}
                </td>
            @endforelse
        </tbody>
    </table>

    <x-pagination :collection="$priorities"/>
@endsection
