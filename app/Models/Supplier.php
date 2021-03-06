<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


    protected $fillable=[
        'account_code'
    ];
    public function supplierInvoices(){
        return $this->hasMany(SupplierInvoice::class);
    }
   static public function getSupplierNameLang(){
        return "supplier_name_".Translation::getLang();
    }
    static public function getdescriptionLang(){
        return "description_".Translation::getLang();
    }
    static public function getaddressLang(){
        return "address_".Translation::getLang();
    }
    public function AccountSubControl(){
        return $this->belongsTo(AccountSubControl::class);
    }
}
