<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Morilog\Jalali\Jalalian;

class breakfastDateCreationMakers implements Rule
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
        $numbers  = ['0','1','2','3','4','5','6','7','8','9' ] ;
        $input = str_split($value);
        if(count($input)>10){
            dd('false-len') ;
        }

        foreach ($input as $word){

            if(in_array($word , $numbers) || $word == "/" ){
                continue ;
            }
            else {

                return false ;
            }
        }


        try {
            $persian_date = explode("/" , request()->date) ;
            $created_at =(new Jalalian($persian_date[0], $persian_date[1], $persian_date[2], 0, 0, 0))->toCarbon()->toDateTimeString() ;
        }catch (\ErrorException){

            return false ;
        }

        return true ;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'please select a right format ';
    }
}