<?php

namespace App\Http\Requests;

use App\Rules\breakfastDateCreationMakers;
use App\Rules\breakfastMakers;
use App\Rules\UniqueCreationDate;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

//fixme start class names with UpperCase
class StoreBreakfastRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //fixme define return type for functions *done
    //todo remove unused methods
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    //fixme define return type for functions *done
    //todo use array shape annotation where ever is possible *done
    #[ArrayShape(['name' => "string[]", 'description' => "string[]", 'date' => "array", 'users' => "array"])] public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'date' => ['required', new breakfastDateCreationMakers(), new UniqueCreationDate()],
            'users' => ['required', new breakfastMakers()]
        ];
    }

    #[ArrayShape(['user.in' => "string"])] public function messages(): array
    {
        return [
            'user.in' => 'please choose a Valid user!'
        ];

    }

}
