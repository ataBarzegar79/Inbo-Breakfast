<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//fixme start class names with UpperCase
class loginRequest extends FormRequest
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
    //todo use array shape annotation where ever is possible
    //fixme define return type for functions
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'password' => ['required'],
        ];
    }
}
