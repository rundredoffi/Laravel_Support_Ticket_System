@props([
    'header' => __('Confirm Delete'),
    'btnLabel' => __('Delete'),
    'btnColor' => 'danger',
    'resourceName' => 'resource',
    'modalId' => 'confirmDelete',
    'route',
    'resourceId',
])

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{ $header }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    {{ __("Are you sure you want to delete the {$resourceName}?") }}
                    <br/>
                    {{ __('This action cannot be reverted!') }}
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('Close') }}</button>
                <form method="POST" action="{{ route("{$route}", $resourceId) }}">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-{{ $btnColor }}" type="submit">{{ $btnLabel }}</button>
                </form>
            </div>
        </div>
    </div>
</div>