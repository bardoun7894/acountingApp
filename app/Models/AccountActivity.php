<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountActivity extends Model
{
    use HasFactory;

    public static function getAccountActivityNameLang()
    {
        return "account_activity_name_" . Translation::getLang();
    }
}
