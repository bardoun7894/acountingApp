<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReturnInvoiceDetail extends Model
{
    use HasFactory;


    // fillable
    protected $fillable = [
       'sale_return_quantity'
    ];
    public function customerReturnInvoice()
    {
        return $this->belongsTo(CustomerReturnInvoice::class);
    }
    public function customerInvoice(){
        return $this->belongsTo(CustomerInvoice::class);
    }

}
