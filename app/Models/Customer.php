<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'account_code'
    ];
   static public function getCustomerNameLang(){
        return "customer_name_".Translation::getLang();
    }
    static  public function getDescriptionLang(){
        return "description_".Translation::getLang();
    }
    static   public function getAddressLang(){
        return "address_".Translation::getLang();
    }
    public function accountSubControl(){
       return $this->belongsTo(AccountSubControl::class);
    }


}
