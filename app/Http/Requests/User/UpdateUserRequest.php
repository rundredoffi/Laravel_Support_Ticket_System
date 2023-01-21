<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\UserRoleRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:60'],
            'last_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . ($this->user->id)],
            'role' => ['required', 'sometimes', 'integer', Rule::in(User::roles()), new UserRoleRule($this->user)],
        ];
    }
}
