<?php

namespace App\Rules;

use ErrorException;
use Illuminate\Contracts\Validation\Rule;
use Morilog\Jalali\Jalalian;

class BreakfastDateCreationMakers implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $input = str_split($value);
        if (count($input) > 10) {
            dd('false-len');
        }

        foreach ($input as $word) {

            if (in_array($word, $numbers) || $word == "/") {
                continue;
            } else {

                return false;
            }
        }


        try {
            $persianDate = explode("/", request()->date);
            $createdAt = (new Jalalian($persianDate[0], $persianDate[1], $persianDate[2], 0, 0, 0))
                ->toCarbon()->toDateTimeString();
        } catch (ErrorException) {

            return false;
        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'please select a right format ';
    }
}
