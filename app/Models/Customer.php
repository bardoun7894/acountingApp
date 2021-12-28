<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

   static public function getCustomerNameLang(){
        return "customer_name_".Translation::getLang();
    }
    static  public function getDescriptionLang(){
        return "description_".Translation::getLang();
    }
    static   public function getAddressLang(){
        return "address_".Translation::getLang();
    }


}
