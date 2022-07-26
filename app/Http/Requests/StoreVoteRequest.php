<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

//fixme start class names with UpperCase *done

/**
 * @property mixed $rate
 * @property mixed $description
 */
class StoreVoteRequest extends FormRequest
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
    #[ArrayShape(['rate' => "string[]", 'description' => "string[]"])] public function rules(): array
    {
        return [
            'rate' => ['required', 'numeric', 'between:1,10'],
            'description' => ['required', 'max:255'],
        ];
    }

    #[ArrayShape(['rate.between' => "string"])] public function messages(): array
    {
        return [
            'rate.between' => 'your rate should be between 1 and 10 '
        ];
    }

}
