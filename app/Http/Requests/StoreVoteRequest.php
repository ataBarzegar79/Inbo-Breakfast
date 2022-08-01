<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $rate
 * @property mixed $description
 */
class StoreVoteRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['rate' => "string[]", 'description' => "string[]"])]
    public function rules(): array
    {
        return [
            'rate' => ['required', 'numeric', 'between:1,10'],
            'description' => ['required', 'max:255'],
        ];
    }

    #[ArrayShape(['rate.between' => "string"])]
    public function messages(): array
    {
        return [
            'rate.between' => 'your rate should be between 1 and 10 '
        ];
    }

}
