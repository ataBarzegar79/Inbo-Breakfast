<?php

namespace App\Models\Http\Requests;

use App\Rules\breakfastDateCreationMakers;
use App\Rules\breakfastMakers;
use Illuminate\Foundation\Http\FormRequest;

class storeBreakfastRequest extends FormRequest
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

//        dd(request()->date) ;
         return [
            'name'=>['required' , 'max:255' ] ,
            'description'=>['max:255'] ,
            'date' =>['required' , new breakfastDateCreationMakers()] ,
            'users' =>['required' ,new breakfastMakers() ]
             ];


    }


    public function messages()
    {
        return [
            'user.in' => 'please choose a Valid user!'
        ];

    }
}
