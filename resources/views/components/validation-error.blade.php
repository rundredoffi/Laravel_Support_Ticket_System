@props(['input'])

@error($input)
    <span class="invalid-feedback">
        {{ $message }}
    </span>
@enderror