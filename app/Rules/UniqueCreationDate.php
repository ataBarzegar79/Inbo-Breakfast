<?php

namespace App\Rules;

use App\Models\Breakfast;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Morilog\Jalali\Jalalian;

class UniqueCreationDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $persian_date = explode("/" , $value) ;
        $form_date =(new Jalalian($persian_date[0], $persian_date[1], $persian_date[2], 0, 0, 0))->toCarbon();
        $breakfasts = Breakfast::all() ;
        foreach ($breakfasts as $breakfast){
            $registered_date =  Carbon::createFromFormat('Y-m-d  H:i:s' , $breakfast->created_at);
            if($registered_date->eq($form_date)){
                return  false ;
            }
        }
        return  true ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A breakfast has been set at this date ';
    }
}
