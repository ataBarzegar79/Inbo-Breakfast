<?php

namespace App\Models\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeVoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'rate' => ['required', 'numeric', 'between:1,10'],
            'description' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'rate.between' => 'your rate should be between 1 and 10 '
        ];
    }
}
