<?php

namespace App\Rules;

use App\Services\Support\JalaliService;
use Assert\InvalidArgumentException;
use ErrorException;
use Illuminate\Contracts\Validation\Rule;


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
            return false;
        }

        foreach ($input as $word) {

            if (in_array($word, $numbers) || $word == "/") {
                continue;
            } else {

                return false;
            }
        }


        try {
            $jalaliService = resolve(JalaliService::class);
            $jalaliService->toAdFormat($value);
        } catch (ErrorException |InvalidArgumentException ) {

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
