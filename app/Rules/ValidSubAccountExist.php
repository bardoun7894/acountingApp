<?php

namespace App\Rules;

use App\Models\AccountSubControl;
use App\Models\Translation;
use Illuminate\Contracts\Validation\Rule;

class ValidSubAccountExist implements Rule
{


    private  $table;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
      return $value!=null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if(Translation::getLang()=="en"){
            return 'The  SubAccountControl must have :attribute  ';
        }else{
            return 'الحساب الفرعي لابد يكون تحته  :attribute  ';
        }
    }
}
