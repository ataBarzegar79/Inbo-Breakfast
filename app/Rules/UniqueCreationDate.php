<?php

namespace App\Rules;

use App\Models\Breakfast;
use App\Services\Support\JalaliService;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {


        $jalaliService = resolve(JalaliService::class);
        $formDate = $jalaliService->toAdFormat($value);
        $breakfasts = Breakfast::all();
        foreach ($breakfasts as $breakfast) {
            $registeredDate = Carbon::createFromFormat('Y-m-d  H:i:s', $breakfast->created_at);
            if ($registeredDate->eq($formDate)) {
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
        return 'A breakfast has been set at this date ';
    }
}
