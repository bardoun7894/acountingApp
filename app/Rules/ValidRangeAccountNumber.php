<?php

namespace App\Rules;

use App\Models\Translation;
use Illuminate\Contracts\Validation\Rule;

class ValidRangeAccountNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $min;
    private $max;
    public function __construct($min,$max)
    {
     $this->min =$min;
     $this->max =$max;
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
        return $value >= $this->min && $value <= $this->max;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if(Translation::getLang()=="en"){
            return 'The :attribute must be between '.$this->min." and ".$this->max;
        }else{
            return  'الارقام لابد ان تكون محصورة بين ' .$this->max.' و '.$this->min;

        }
    }
}
