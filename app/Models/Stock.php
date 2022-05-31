<?php

namespace App\Models;

use App\Http\Controllers\PurchaseInvoiceController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function purchases()
    {
        return $this->hasMany(PurchaseCartDetail::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function getProductNameLang()
    {
        return "product_name_" . Translation::getLang();
    }
    public static function getDescriptionLang()
    {
        return "description_" . Translation::getLang();
    }
}
