@extends('layouts.app', [
    'title' => __('Modifier catégorie') . ' - ' . $category->id,
    'columnSize' => 'col-lg-5',
])

@section('content')
    <x-errors/>

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name" class="col-form-label">{{ __('Nom') }}</label>
            <input type="text" class="form-control" id="name" name="name"
                    minlength="3" maxlength="60" value="{{ old('name', $category->name) }}" required/>
        </div>

        <button class="btn btn-primary btn-block" type="submit">{{ __('Sauvegarder') }}</button>
    </form>

    @can ('delete', $category)
        <hr/>

        <x-buttons.delete-with-confirmation class="btn-block" route="categories.destroy" resourceName="category" :resourceId="$category"/>
    @endcan
@endsection