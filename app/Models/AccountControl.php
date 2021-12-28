<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountControl extends Model
{
    use HasFactory;
    public function accountHead(){
        return $this->belongsTo(AccountHead::class);
    }

   public function accountSubControls(){
        return $this->hasMany(AccountSubControl::class);
    }
    static public function getAccountControlNameLang(){
        return 'account_control_name_'.Translation::getLang();
    }
}
