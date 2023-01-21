@props([
    'dataTarget' => 'confirmDelete',
    'btnColor' => 'danger',
    'route',
    'resourceName',
    'resourceId'
])

<button type="button" {{ $attributes->merge(['class' => 'btn btn-'.$btnColor]) }} data-toggle="modal" data-target="#{{ $dataTarget }}">
    {{ __('Delete') }}
</button>

<x-modals.confirm-delete :route="$route" :resourceName="$resourceName" :resourceId="$resourceId"/>