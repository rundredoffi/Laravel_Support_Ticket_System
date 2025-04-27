@extends('layouts.app', [
    'title' => __('Create Category'),
    'columnSize' => 'col-lg-5',
])

@section('content')
    <x-errors/>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">{{ __('Nom') }}</label>
            <input type="text" class="form-control" id="name" name="name"
                    minlength="3" maxlength="60" value="{{ old('name') }}" required/>
        </div>

        <button class="btn btn-primary btn-block" type="submit">{{ __('Créer') }}</button>
    </form>
@endsection