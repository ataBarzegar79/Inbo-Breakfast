<?php

namespace App\Http\Requests;

use App\Rules\breakfastDateCreationMakers;
use App\Rules\breakfastMakers;
use App\Rules\UniqueCreationDate;
use Illuminate\Foundation\Http\FormRequest;

class BreakfastUpdateRequest extends FormRequest
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
           'name'=>['required' , 'max:255' ] ,
           'description'=>['required','max:255'] ,
           'users' =>['required' ,new breakfastMakers() ]
       ];

    }


}
