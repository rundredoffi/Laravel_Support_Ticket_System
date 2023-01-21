@extends('layouts.app', [
    'title' => __('Ticket') . ' - ' . $ticket->id,
    'columnSize' => 'col-lg-8'
])

@section('content')
    <div class="row text-center">
        <div class="col-lg-4">
            <dl class="dl-horizontal">
                <dt>
                    {{ __('Created by') }}
                </dt>
                <dd>
                    {{ $ticket->user->full_name }}
                </dd>
                <dt>
                    {{ __('Created at') }}
                </dt>
                <dd>
                    <x-datetime :date="$ticket->created_at" showDate/>
                </dd>
                <dt>
                    {{ __('Last updated') }}
                </dt>
                <dd>
                    <x-datetime :date="$ticket->updated_at" showDate/>
                </dd>
            </dl>
        </div>

        <div class="col-lg-4">
            <dl class="dl-horizontal">
                <dt>
                    {{ __('Priority') }}
                </dt>
                <dd>
                    {{ $ticket->priority->name ?? __('Not specified') }}
                </dd>
                <dt>
                    {{ __('Status') }}
                </dt>
                <dd>
                    <x-tickets.status :ticket="$ticket"/>
                </dd>
                <dt>
                    {{ __('Agent') }}
                </dt>
                <dd>
                    <x-users.username :user="$ticket->agent"/>
                </dd>
            </dl>
        </div>

        <div class="col-lg-4">
            <dl class="dl-horizontal">
                <dt>
                    {{ __('Labels') }}
                </dt>
                <dd>
                    @foreach ($ticket->labels as $label)
                        <span class="badge badge-secondary">
                            {{ $label->name }}
                        </span>
                    @endforeach
                </dd>
                <dt>
                    {{ __('Categories') }}
                </dt>
                <dd>
                    @foreach ($ticket->categories as $category)
                        <span class="badge badge-primary">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </dd>
                <dt>
                    {{ __('Attached files') }}
                </dt>
                <dd>
                    @foreach ($ticket->files as $file)
                        <a href="{{ $file->public_path }}" target="blank">
                            {{ __('File') }} #{{ $loop->iteration }}
                        </a> |
                    @endforeach
                </dd>
            </dl>
        </div>
    </div>

    <div class="col-lg-12 mt-4">
        <div class="btn-toolbar justify-content-center" role="toolbar">
            <div class="mr-1">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#ticketLog">
                    {{ __('Log') }}
                </button>
            </div>

            @can ('close', $ticket)
                <div class="mr-1">
                    <form action="{{ route('tickets.close', $ticket) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="btn btn-info waves-effect waves-light">
                            {{ __('Close') }}
                        </button>
                    </form>
                </div>
            @endcan

            @can ('update', $ticket)
                <div class="mr-1">
                    <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning waves-effect waves-light">
                        {{ __('Edit') }}
                    </a>
                </div>
            @endcan

            @can ('delete', $ticket)
                <div class="mr-1">
                    <x-buttons.delete-with-confirmation route="tickets.destroy" resourceName="ticket" :resourceId="$ticket"/>
                </div>
            @endcan
        </div>
    </div>

    <hr class="my-4"/>

    <div class="media mb-3">
        <div class="media-body">
            <h5 class="text-primary m-0">
                {{ $ticket->title }}
            </h5>
        </div>
    </div>

    <p>
        {{ $ticket->description }}
    </p>

    <hr class="my-4"/>

    @can ('create', [\App\Models\TicketComment::class, $ticket])
        <form method="POST" action="{{ route('tickets.comments.store', $ticket->id) }}">
            @csrf

            <div class="media mt-3">
                <div class="media-body">
                    <textarea class="form-control" name="message" rows="5" placeholder="{{ __('Reply here') }}..."
                            minlength="10" maxlength="10000" required>{{ old('message') }}</textarea>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light mt-3">
                    <i class="fa fa-paper-plane mr-1"></i>
                    {{ __('Submit') }}
                </button>
            </div>
        </form>
    @endcan

    @if ($ticket->isClosed())
        <div class="alert alert-danger text-center">
            {{ __('The ticket is closed and thus, you cannot reply to it.') }}
        </div>
    @endif

    <hr class="my-4"/>

    <h5>
        <i class="fa fa-comments mr-1"></i>
        {{ __('Comments') }}
    </h5>
    <div class="row">
        <div class="col-md-12">
            <x-tickets.comments :comments="$ticket->comments"/>
        </div>
    </div>

    <hr class="my-4"/>

    <x-modals.info modalId="ticketLog" header="{{ __('Ticket Log') }}">
        <x-activity-logs-table :logs="$ticket->activities"/>
    </x-modals.info>
@endsection