<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInvoiceDetail extends Model
{
    use HasFactory;

    public function stock(){
       return $this->belongsTo(Stock::class);
    }
    public function customer(){
       return $this->belongsTo(Customer::class);
    }
    public function customer_invoice(){
       return $this->belongsTo(CustomerInvoice::class);
    }
    public function customer_payment(){
       return $this->belongsTo(CustomerPayment::class);
    }
    public function user(){
       return $this->belongsTo(User::class);
    }
    public function branch(){
       return $this->belongsTo(Branch::class);
    }

}
