@extends('layouts.app', [
    'title' => __('Create Ticket'),
    'columnSize' => 'col-lg-8',
])

@section('content')
    <x-errors/>

    <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
        @csrf

        <x-tickets.form/>

        <hr/>

        <button type="submit" class="btn btn-primary btn-block">{{ __('Submit') }}</button>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>
@endsection
