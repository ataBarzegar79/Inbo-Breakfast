<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class BreakfastMakers implements Rule
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
        $all_users = User::all();
        $all_users_id = [];

        foreach ($all_users as $user) {
            $all_users_id[] = (string)$user->id;
        }
        foreach ($value as $id) {
            if (!in_array($id, $all_users_id)) {
                return false;
            }
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
        return ' you have selected wrong :attribute  ';
    }
}
