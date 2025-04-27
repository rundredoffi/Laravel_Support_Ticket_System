@props([
    'ticket' => null,
    'agents' => null,
])

<div class="form-group mb-4">
    <label for="title">{{ __('Titre') }}</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $ticket->title ?? '') }}"
            placeholder="{{ __('Bref description du problème') }}" minlength="6" maxlength="100" autofocus required>
</div>

<div class="form-group mb-4">
    <label for="description">{{ __('Description') }}</label>
    <textarea class="form-control" rows="6" id="description" name="description" placeholder="{{ __('Décrivez votre problème de façon détaillé.') }}"
            minlength="30" maxlength="10000" required>{{ old('description', $ticket->description ?? '') }}</textarea>
</div>

<div class="form-group mb-4">
    <label>{{ __('Labels') }}</label>
    <br/>
    @foreach ($labels as $label)
        <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" id="label-{{ $label->id }}" name="labels[]"
                    value="{{ $label->id }}" @checked((is_array(old('labels')) && in_array($label->id, old('labels')) || isset($ticket) && $ticket->labels->contains($label->id)))>
            <label class="form-check-label" for="label-{{ $label->id }}">
                {{ $label->name }}
            </label>
        </div>
    @endforeach
</div>

<div class="form-group mb-4">
    <label>{{ __('Catégories') }}</label>
    <br/>
    @foreach ($categories as $category)
        <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}"
                    @checked((is_array(old('categories')) && in_array($category->id, old('categories')) || isset($ticket) && $ticket->categories->contains($category->id)))>
            <label class="form-check-label" for="category-{{ $category->id }}">
                {{ $category->name }}
            </label>
        </div>
    @endforeach
</div>

<div class="form-group">
    <label for="priority">{{ __('Priorité') }}</label>
    <select class="form-control" id="priority" name="priority_id" required>
        @foreach ($priorities as $priority)
            <option value="{{ $priority->id }}" @selected(old('priority_id', $ticket->priority_id ?? '') == $priority->id)>{{ $priority->name }}</option>
        @endforeach
    </select>
</div>

@if ($ticket && $agents !== null)
    <div class="form-group">
        <label for="agent_id">{{ __('Support assigné') }}</label>
        <select class="form-control" id="agent_id" name="agent_id">
            <option></option>
            @foreach ($agents as $agent)
                <option value="{{ $agent->id }}" @selected(old('agent_id', $ticket->agent_id ?? '') == $agent->id)>{{ $agent->full_name }}</option>
            @endforeach
        </select>
    </div>
@endif

@if (!$ticket)
    <label>{{ __('Files') }} ({{ __('Non requis') }})</label>
    <div class="form-group">
        <input type="file" class="filestyle" name="files[]"
                data-dragdrop="true" data-text="{{ __('Browse') }}" data-badge="true" data-placeholder="{{ __('No files') }}" data-buttonBefore="true"
                aria-describedby="multipleFilesInfo" accept=".jpeg, .jpg, .png, .pdf, .txt, .avi, .mpg, .mpeg, .mp4, .csv" multiple>
        <small id="multipleFilesInfo" class="form-text text-muted">
            {{ __('Maintenez les bouttons CTRL/CMD pour sélectionner plusieurs fichiers.') }}
        </small>
        <small class="form-text text-muted">
            <strong>{{ __('Fichiers accepté') }}:</strong> .jpeg, .jpg, .png, .pdf, .txt, .avi, .mpg, .mpeg, .mp4, .csv •
            <strong>{{ __('Taille maximale') }}:</strong> 2 MB •
            <strong>{{ __('Nombre maximale de fichier') }}:</strong> 5
        </small>
    </div>
@endif