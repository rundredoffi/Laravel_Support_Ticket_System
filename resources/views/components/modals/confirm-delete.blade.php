@props([
    'header' => __('Confirmer la suppression'),
    'btnLabel' => __('Supprimer'),
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
                    {{ __("Êtes vous sure de supprimer {$resourceName}?") }}
                    <br/>
                    {{ __('Cette action ne peut être annulé!') }}
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('Fermer') }}</button>
                <form method="POST" action="{{ route("{$route}", $resourceId) }}">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-{{ $btnColor }}" type="submit">{{ $btnLabel }}</button>
                </form>
            </div>
        </div>
    </div>
</div>