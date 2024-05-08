<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReturnInvoiceDetail extends Model
{
    use HasFactory;

    public function customerReturnInvoice()
    {
        return $this->belongsTo(CustomerReturnInvoice::class);
    }

}
