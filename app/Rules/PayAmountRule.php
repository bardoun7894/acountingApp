<?php

namespace App\Rules;

use App\Models\Translation;
use Illuminate\Contracts\Validation\Rule;

class PayAmountRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private  $previous_remaining_amount;
    public function __construct($previous_remaining_amount)
    {
    $this->previous_remaining_amount =$previous_remaining_amount;
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
     return $this->previous_remaining_amount >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        if(Translation::getLang()=="en"){
            return 'Payment be must less than or equal to previous remaining amount.';
        }else{
            return  'مبلغ الدفع يجب ان يكون اكبر من او يساوي المبلغ المتبقي السابق';

        }

    }
}
