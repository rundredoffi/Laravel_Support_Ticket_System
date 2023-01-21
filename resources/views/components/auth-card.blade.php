<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">{{ __($header) ?? '' }}</h1>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>