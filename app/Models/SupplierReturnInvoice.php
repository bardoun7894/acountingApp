<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierReturnInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
    'supplier_invoice_id', 'invoiceno',
    'user_id', 'company_id', 'supplier_id',
    'branch_id', 'invoice_date',
    'description', 'total_amount'
    ];
    protected $casts = [
        'invoice_date' => 'date',
    ];
    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function supplierInvoice()
    {
    return $this->belongsTo(SupplierInvoice::class, 'supplier_invoice_id', 'id');
    }

    //user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
