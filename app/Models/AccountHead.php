<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function accountControls(){
        return $this->hasMany(AccountControl::class);
    }
    public function accountSubControls(){
        return $this->hasMany(AccountSubControl::class);
    }
   static public function getAccounHeadNameLang(){
        return 'account_head_name_'.Translation::getLang();
}

}
