<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSubControl extends Model
{
    use HasFactory;


    public function accountHead()
    {
        return $this->belongsTo(
            AccountHead::class,
            "account_head_id",
            "account_code"
        );
    }

    public function accountControl()
    {
        return $this->belongsTo(
            AccountControl::class,

            "account_control_id",
            "account_code"
        );
    }

    public static function getAccountSubControlNameLang()
    {
        return "account_sub_control_name_" . Translation::getLang();
    }

    public function customers()
    {
      return  $this->hasMany(Customer::class);
    }

    public function suppliers()
    {
      return  $this->hasMany(Supplier::class);
    }
}
