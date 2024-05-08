<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReturnInvoice extends Model
{
    use HasFactory;



    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function customerInvoice()
    {
        return $this->belongsTo(CustomerInvoice::class);
    }
    public function customerReturnInvoiceDetails()
    {
        return $this->hasMany(CustomerReturnInvoiceDetail::class);
    }
}
