<?php

namespace App\Http\Requests;

use App\Rules\BreakfastMakers;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $name
 * @property mixed $description
 * @property mixed $users
 */
class BreakfastUpdateRequest extends FormRequest
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
    #[ArrayShape(['name' => "string[]", 'description' => "string[]", 'users' => "array"])] public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'users' => ['required', new BreakfastMakers()]
        ];
    }

}
