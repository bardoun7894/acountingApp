<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    use HasFactory;

    public function accountControls()
    {
        return $this->hasMany(
            AccountControl::class,
            "account_head_id",
            "account_code"
        );
    }
    public function accountSubControls()
    {
        return $this->hasMany(
            AccountSubControl::class,
            "account_head_id",
            "account_code"
        );
    }
    public static function getAccountHeadNameLang()
    {
        return "account_head_name_" . Translation::getLang();
    }
}
