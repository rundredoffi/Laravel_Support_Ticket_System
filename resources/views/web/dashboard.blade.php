@extends('layouts.app', [
    'title' => __('Dashboard'),
    'columnSize' => 'col-lg-12'
])

@section('content')
    <div class="row">
        <x-statistics-card title="{{ __('Total tickets') }}" :value="$totalTickets"/>
        <x-statistics-card color="warning" title="{{ __('Open tickets') }}" :value="$openTickets"/>
        <x-statistics-card color="success" title="{{ __('Closed tickets') }}" :value="$closedTickets"/>
    </div>
@endsection