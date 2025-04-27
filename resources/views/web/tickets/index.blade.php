@extends('layouts.app', ['title' => __('Tickets')])

@section('content')
    <x-errors/>

    <form class="form-inline mb-3" action="{{ route('tickets.index') }}" method="GET">
        <label class="sr-only" for="status">{{ __('Status') }}</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">{{ __('Status') }}</div>
            </div>
            <select class="form-control" id="status" name="status">
                <option value="">{{ __('Tous') }}</option>
                <option value="open" @selected(request()->status === 'open')>{{ __('Ouvert') }}</option>
                <option value="closed" @selected(request()->status === 'closed')>{{ __('Clôturé') }}</option>
            </select>
        </div>

        <label class="sr-only" for="priority">{{ __('Priorité') }}</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">{{ __('Priorité') }}</div>
            </div>
            <select class="form-control" id="priority" name="priority">
                <option value="">{{ __('Tous') }}</option>
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->id }}" @selected(request()->priority == $priority->id)>{{ $priority->name }}</option>
                @endforeach
            </select>
        </div>

        <label class="sr-only" for="category">{{ __('Catégorie') }}</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">{{ __('Catégorie') }}</div>
            </div>
            <select class="form-control" id="category" name="category">
                <option value="">{{ __('Tous') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request()->category == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mb-2">{{ __('Rechercher') }}</button>
    </form>

    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>{{ __('Titre') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Priorité') }}</th>
                <th>{{ __('Support assigné') }}</th>
                <th>{{ __('Dernière mise à jour') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>
                        <a href="{{ route('tickets.show', $ticket) }}">
                            {{ $ticket->title }}
                        </a>
                    </td>
                    <td>
                        <x-tickets.status :ticket="$ticket"/>
                    </td>
                    <td>
                        {{ $ticket->priority->name ?? __('Non specifiée') }}
                    </td>
                    <td>
                        <x-users.username :user="$ticket->agent"/>
                    </td>
                    <td>
                        <x-datetime :date="$ticket->updated_at"/>
                    </td>
                </tr>
            @empty
                <td colspan="5">
                    {{ __('Aucun ticket trouver.') }}
                </td>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('tickets.create') }}" class="btn btn-success">
        {{ __('Créer un ticket') }}
    </a>

    <x-pagination :collection="$tickets"/>
@endsection
