@extends('layouts.app', [
    'title' => __('Catégories'),
])

@section('content')
    <x-errors/>

    @can ('create', \App\Models\Category::class)
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
            {{ __('Créer une catégorie') }}
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
            @forelse ($categories as $category)
                <tr>
                    <td>
                        {{ $category->id }}
                    </td>
                    <td>
                        @can ('update', $category)
                            <a href="{{ route('categories.edit', $category) }}">
                                {{ $category->name }}
                            </a>
                        @else
                            {{ $category->name }}
                        @endcan
                    </td>
                    <td>
                        <x-datetime :date="$category->created_at"/>
                    </td>
                </tr>
            @empty
                <td colspan="3">
                    {{ __('Aucune catégorie existante.') }}
                </td>
            @endforelse
        </tbody>
    </table>

    <x-pagination :collection="$categories"/>
@endsection
