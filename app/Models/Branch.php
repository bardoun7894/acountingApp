<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function stocks(){
        return $this->hasMany(Stock::class);
    }
   public function stores(){
        return $this->hasMany(Store::class);
    }
    static public function getBranchNameLang(){
           return "branch_name_".Translation::getLang();
    }
}
