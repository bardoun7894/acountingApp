<?php

namespace App\Rules;

use App\Models\Sale;
use Illuminate\Contracts\Validation\Rule;

class SaleCartRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $stock_id;
    public function __construct($stock_id)
    {
        $this->stock_id=$stock_id;
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
        $purchase=Sale::where('stock_id', $this->stock_id)->first();
        if(!isset($purchase)){
            return true;
        }else{
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
        return 'this product is already in sale cart';
    }
}
