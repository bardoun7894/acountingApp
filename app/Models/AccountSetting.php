<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    use HasFactory;

public function accountHead(){
    return $this->belongsTo(AccountHead::class);
}
public function accountControl(){
    return $this->belongsTo(AccountControl::class);
}

public function accountSubControl(){
    return $this->belongsTo(AccountSubControl::class);
}


public function accountActivity(){
    return $this->belongsTo(AccountActivity::class);
}

public function branch(){
    return $this->belongsTo(Branch::class);
}

}
