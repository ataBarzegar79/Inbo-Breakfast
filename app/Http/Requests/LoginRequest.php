<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

//fixme start class names with UpperCase *done

/**
 * @property mixed $name
 * @property mixed $password
 */
class LoginRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    //todo use array shape annotation where ever is possible *done
    //fixme define return type for functions *done
    #[ArrayShape(['name' => "string[]", 'password' => "string[]"])] public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'password' => ['required'],
        ];
    }

}
