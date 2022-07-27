<?php

namespace App\Http\Requests;

use App\Rules\BreakfastDateCreationMakers;
use App\Rules\BreakfastMakers;
use App\Rules\UniqueCreationDate;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

//fixme start class names with UpperCase *done

/**
 * @property mixed $date
 * @property mixed $name
 * @property mixed $description
 * @property mixed $users
 */
class StoreBreakfastRequest extends FormRequest
{


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
            'date' => ['required', new BreakfastDateCreationMakers(), new UniqueCreationDate()],
            'users' => ['required', new BreakfastMakers()]
        ];
    }

    #[ArrayShape(['user.in' => "string"])] public function messages(): array
    {
        return [
            'user.in' => 'please choose a Valid user!'
        ];

    }

}
