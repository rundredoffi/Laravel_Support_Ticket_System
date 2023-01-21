@if ($errors->any())
    <div class="alert alert-danger">
        <h5 class="mb-3">{{ __('We were unable to proceed with your request due to the following reasons:') }}</h5>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif