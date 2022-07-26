<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//fixme start class names with UpperCase
class updateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //fixme define return type for functions
    //todo remove unused methods
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    //fixme define return type for functions
    //todo use array shape annotation where ever is possible
    public function rules()
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
