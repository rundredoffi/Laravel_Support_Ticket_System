@forelse ($comments as $comment)
    <div class="border border-secondary border-left-0 border-right-0 p-3 mb-3">
        <div class="mb-3">
            <h5 class="mb-0">
                {{ $comment->user->full_name }}
                <x-users.role-badge :user="$comment->user"/>
            </h5>
            <small>
                <x-datetime :date="$comment->created_at" showDate/>
            </small>
        </div>

        <p>
            {{ $comment->message }}
        </p>

        @can ('update', $comment)
            <ul class="list-inline d-sm-flex my-0">
                <li class="list-inline-item ml-auto">
                    <a class="text-warning" href="{{ route('tickets.comments.edit', $comment) }}">
                        <i class="fa fa-pencil"></i> {{ __('Edit') }}
                    </a>
                </li>
            </ul>
        @endcan
    </div>
@empty
    <span>{{ __('No comments have been posted yet.') }}</span>
@endforelse