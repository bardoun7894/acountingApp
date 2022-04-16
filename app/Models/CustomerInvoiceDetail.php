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

}
