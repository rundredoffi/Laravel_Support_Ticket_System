@props([
    'user',
    'name' => 'role',
    'required' => false,
])

<select class="form-control" id="{{ $name }}" name="{{ $name }}" {{ $required }}>
    <option value="{{ \App\Models\User::ADMINISTRATOR }}" @selected(old($name, $user->role) == \App\Models\User::ADMINISTRATOR)>{{__('Administrateur')}}</option>
    <option value="{{ \App\Models\User::AGENT }}" @selected(old($name, $user->role) == \App\Models\User::AGENT)>{{__('Support')}}</option>
    <option value="{{ \App\Models\User::REGULAR_USER }}" @selected(old($name, $user->role) == \App\Models\User::REGULAR_USER)>{{__('Utilisateur')}}</option>
</select>