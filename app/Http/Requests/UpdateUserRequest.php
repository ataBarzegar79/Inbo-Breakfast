<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $avatar
 * @property mixed $email
 * @property mixed $is_admin
 * @property mixed $name
 */
class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'name' => "string[]",
        'email' => "string[]",
        'password' => "string[]",
        'avatar' => "string[]",
        'is_admin' => "string[]"
        ])
    ]
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:rfc'],
            'password' => ['required'],
            'avatar' => ['file', 'image', 'max:512'],
            'is_admin' => ['required', 'in:yes,no']
        ];
    }

}
