<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    static public function getStoreNameLang(){
        return 'store_name_'.Translation::getLang();
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
