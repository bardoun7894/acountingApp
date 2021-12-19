<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountControl extends Model
{
    use HasFactory;
    public function AccountHead(){
        return $this->belongsTo(AccountHead::class);
    }
}
