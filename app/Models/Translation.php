<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Translation extends Model
{
    use HasFactory;

    static public function getLang(){
        $lang = LaravelLocalization::getCurrentLocale();
        return $lang;
    }

}
