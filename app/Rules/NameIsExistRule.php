<?php

namespace App\Rules;

use App\Models\AccountControl;
use App\Models\AccountHead;
use App\Models\AccountSubControl;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\App;

class NameIsExistRule implements Rule
{
    private $name_lang;
    private $name;
    public function __construct($name, $name_lang)
    {
        $this->name = $name;
        $this->name_lang = $name_lang;
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
        if ($this->name_lang == "product_name_" . App::getLocale()) {
            $name = Stock::where($this->name_lang, $this->name)->first();
        } elseif ($this->name_lang == "category_name_" . App::getLocale()) {
            $name = Category::where($this->name_lang, $this->name)->first();
        } elseif ($this->name_lang == "unit_name_" . App::getLocale()) {
            $name = Unit::where($this->name_lang, $this->name)->first();
        } elseif ($this->name_lang == "supplier_name_" . App::getLocale()) {
            $name = Supplier::where($this->name_lang, $this->name)->first();
        } elseif ($this->name_lang == "customer_name_" . App::getLocale()) {
            $name = Customer::where($this->name_lang, $this->name)->first();
        } elseif ($this->name_lang == "employee_name_" . App::getLocale()) {
            $name = Employee::where($this->name_lang, $this->name)->first();
        } elseif ($this->name_lang == "account_head_name_" . App::getLocale()) {
            $name = AccountHead::where($this->name_lang, $this->name)->first();
        } elseif ($this->name_lang == "branch_name_" . App::getLocale()) {
            $name = Branch::where($this->name_lang, $this->name)->first();
        } elseif (
            $this->name_lang ==
            "account_sub_control_name_" . App::getLocale()
        ) {
            $name = AccountSubControl::where(
                $this->name_lang,
                $this->name
            )->first();
        } elseif (
            $this->name_lang ==
            "account_control_name_" . App::getLocale()
        ) {
            $name = AccountControl::where(
                $this->name_lang,
                $this->name
            )->first();
        }

        if (!isset($name)) {
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
            return "" . explode("_", $this->name)[0] . " is already  set";
        } else {
            return explode("_", $this->name)[0] .
                " تمت اضافته من قبل المرجو التأكد من الاسم ";
        }
    }
}
