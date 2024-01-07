<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInvoice extends Model
{
    use HasFactory;

    public static function getTitleLang()
    {
        return "title_".Translation::getLang();
    }

    public function customer()
    {
       return $this->belongsTo(Customer::class);
    }
    public function customer_payments()
    {
       return $this->hasMany(CustomerPayment::class);
    }
    //customer invoice details
    public function customerInvoiceDetails()
    {
       return $this->hasMany(CustomerInvoiceDetail::class);
    }
}
