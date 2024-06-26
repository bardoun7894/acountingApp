<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    use HasFactory;

    public function accountSubControl(){
        return $this->belongsTo(AccountSubControl::class);
    }
}
