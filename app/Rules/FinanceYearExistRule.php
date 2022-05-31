<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\App;

class FinanceYearExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $finance_year;
    public function __construct($finance_year)
    {
        $this->finance_year = $finance_year;
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
        $finance_year = \App\Models\FinanceYear::where(
            "financial_year",
            $this->finance_year
        )->first();
        if (!isset($finance_year)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if (App::getLocale() == "en") {
            return "Finance Year is already exist";
        } elseif (App::getLocale() == "ar") {
            return "السنة المالية موجودة مسبقا";
        }
    }
}
