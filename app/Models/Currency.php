<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Currency extends Model
{
    use HasFactory;

    public static function getCurrencyName()
    {
        return "currency_name_" . App::getLocale();
    }
}
