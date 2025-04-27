@extends('layouts.app', [
    'title' => __('Modifier label') . ' - ' . $label->id,
    'columnSize' => 'col-lg-5',
])

@section('content')
    <x-errors/>

    <form method="POST" action="{{ route('labels.update', $label) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name" class="col-form-label">{{ __('Nom') }}</label>
            <input type="text" class="form-control" id="name" name="name"
                    minlength="3" maxlength="60" value="{{ old('name', $label->name) }}" required/>
        </div>

        <button class="btn btn-primary btn-block" type="submit">{{ __('Sauvegarder') }}</button>
    </form>

    @can ('delete', $label)
        <hr/>

        <x-buttons.delete-with-confirmation class="btn-block" route="labels.destroy" resourceName="label" :resourceId="$label"/>
    @endcan
@endsection