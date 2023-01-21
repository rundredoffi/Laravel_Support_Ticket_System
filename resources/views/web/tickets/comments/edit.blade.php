@extends('layouts.app', [
    'title' => __('Edit Comment') . ' - ' . $comment->id,
    'columnSize' => 'col-lg-8',
])

@section('content')
    <x-errors/>

    <form method="POST" action="{{ route('tickets.comments.update', $comment) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="message" class="col-form-label">{{ __('Message') }}</label>
            <textarea class="form-control" id="message" name="message" rows="5"
                    minlength="10" maxlength="10000" required>{{ old('message', $comment->message) }}</textarea>
        </div>

        <button class="btn btn-primary btn-block" type="submit">{{ __('Save') }}</button>
    </form>

    @can ('delete', $comment)
        <hr/>

        <x-buttons.delete-with-confirmation class="btn-block" route="tickets.comments.destroy" resourceName="comment" :resourceId="$comment"/>
    @endcan
@endsection
