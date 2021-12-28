<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;

class Category extends Model
{
    use HasFactory;

    public function stocks(){
        return $this->hasMany(Stock::class);
        }
   public function branch(){
        return $this->belongsTo(Branch::class);
   }
static public function getCategoryNameLang($lang){
       return "category_name_".$lang;
}

}
