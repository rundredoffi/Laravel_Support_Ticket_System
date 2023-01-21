@extends('layouts.app', [
    'title' => __('Priority') . ' - ' . $priority->id,
    'columnSize' => 'col-lg-5',
])

@section('content')
    <x-errors/>

    <form method="POST" action="{{ route('priorities.update', $priority) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name" class="col-form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name"
                    minlength="3" maxlength="60" value="{{ old('name', $priority->name) }}" required/>
        </div>

        <button class="btn btn-primary btn-block" type="submit">{{ __('Save') }}</button>
    </form>

    @can ('delete', $priority)
        <hr/>

        <x-buttons.delete-with-confirmation class="btn-block" route="priorities.destroy" resourceName="priority" :resourceId="$priority"/>
    @endcan
@endsection
