<?php

namespace App\Rules;

use App\Models\Stock;
use App\Models\Translation;
use Illuminate\Contracts\Validation\Rule;

class ValidSalePrice implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

 private $stock_id;


 public function __construct($stock_id)
 {
     $this->stock_id =$stock_id;
 }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute,$value)
    {
        $stock =Stock::find( $this->stock_id);
        return $value >= $stock->current_purchase_unit_price ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if(Translation::getLang()=="en"){
            return 'The Sale Price must be bigger than Purchase Price';
        }else{
            return  'ثمن البيع يجب ان يكون اكثر من ثمن الشراء ' ;

        }
    }
}
