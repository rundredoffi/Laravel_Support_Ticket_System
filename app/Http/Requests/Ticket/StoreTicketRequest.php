<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'title' => ['required', 'min:6', 'max:100'],
            'description' => ['required', 'min:30', 'max:10000'],
            'labels' => ['required'],
            'labels.*' => ['exists:labels,id'],
            'categories' => ['required'],
            'categories.*' => ['exists:categories,id'],
            'priority_id' => ['required', 'integer', 'exists:priorities,id'],
            'files' => ['nullable', 'max:5'],
            'files.*' => ['file', 'mimes:jpeg,jpg,png,pdf,txt,avi,mpg,mpeg,mp4,csv', 'max:2000'],
        ];
    }
}
