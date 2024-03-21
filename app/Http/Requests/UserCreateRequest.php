<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // DEV NOTE: of course, 'alpha' validation would restrict non-english names with special characters, but for purposes of this quick app, lets leave it like this
            'first_name' => ['required', 'alpha', 'between:1,100'],
            'last_name' => ['required', 'alpha', 'between:1,100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'ssn' => ['required', 'regex:/^[0-9]{3}\-[0-9]{2}\-[0-9]{4}$/'],
        ];
    }
}
