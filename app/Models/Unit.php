<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;


    static public function getUnitNameLang(){
        return 'unit_name_'.Translation::getLang();
    }

}
