<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierInvoice extends Model
{
    use HasFactory;

    static public function getTitleLang(){
        return 'title_'.Translation::getLang();
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function supplier_payments(){
        return $this->hasMany(SupplierPayment::class);
    }
}
