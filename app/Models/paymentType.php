<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentType extends Model
{
    use HasFactory;

    static public function getPaymentTypeNameLang(){
        return 'payment_type_name_'.Translation::getLang();
    }

}
