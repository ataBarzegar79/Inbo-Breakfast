<?php

namespace App\Http\Requests;

use App\Models\User;
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

        $all_users = User::all() ;
        $all_users_id = [] ;

        foreach ($all_users as $user){
            $all_users_id[] = (string)$user->id ;
        }


        return [
            'name'=>['required' , 'max:255' ] ,
            'description'=>['max:255'] ,
            'date' =>['required'] ,
            'user' =>['required' ,'in:'.implode(',' ,$all_users_id) ]
        ];


    }


    public function messages()
    {
        return [
            'user.in' => 'please choose a Valid user!'
        ];

    }
}
