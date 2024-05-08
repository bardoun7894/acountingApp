<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierReturnInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_return_invoice_id',
        'supplier_invoice_detail_id',
        'supplier_invoice_id',
        'stock_id',
        'purchase_return_quantity',
        'purchase_return_unit_price',
    ];
    public function stocks(){
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }
    public function supplierInvoice()
    {
        return $this->belongsTo(SupplierInvoice::class, 'supplier_invoice_id', 'id');
    }
    public function supplierReturnInvoice()
    {
        return $this->belongsTo(SupplierReturnInvoice::class, 'supplier_return_invoice_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
