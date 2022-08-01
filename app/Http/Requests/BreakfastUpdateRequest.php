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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string[]", 'description' => "string[]", 'users' => "array"])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'users' => ['required', new BreakfastMakers()]
        ];
    }

}
