<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSubControl extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function accountHead()
    {
        return $this->belongsTo(AccountHead::class);
    }

    public function accountControl()
    {
        return $this->belongsTo(
            AccountControl::class,
            "account_code",
            "account_control_id"
        );
    }

    public static function getAccountSubControlNameLang()
    {
        return "account_sub_control_name_" . Translation::getLang();
    }

    public function customers()
    {
        $this->hasMany(Customer::class);
    }

    public function suppliers()
    {
        $this->hasMany(Supplier::class);
    }
}
