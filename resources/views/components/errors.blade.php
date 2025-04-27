@if ($errors->any())
    <div class="alert alert-danger">
        <h5 class="mb-3">{{ __('Nous avons pas pu donner suite à votre demande pour les raisons suivantes :') }}</h5>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif