<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

protected $fillable=[
    'full_name_en','username','full_name_ar','contact_number','email'
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //create relationship with user_type table
    public function user_type()
    {
      return $this->belongsTo(UserType::class);
    }
    public function store()
    {
      return $this->belongsTo(Store::class);
    }
    public function branch()
    {
      return $this->belongsTo(Branch::class);
    }
    public function accountHeads()
    {
        return $this->hasMany(AccountHead::class);
    }
    public function accountSubControls()
    {
        return $this->hasMany(AccountSubControl::class);
    }
    public function stocks()
    {
      return $this->hasMany(Stock::class);
    }
    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function supplierInvoices(){
        return $this->hasMany(SupplierInvoice::class);
    }
static public function getFullnameLang(){
   return "full_name_".Translation::getLang();

}
 static public function getAddressLang(){
    return "address_".Translation::getLang();

}

 static public function getFullName(){
        $full_name_lang = self::getFullnameLang();
        return Auth::user()->$full_name_lang;

}
// customerInvoice
public function customerInvoices(){
    return $this->hasMany(CustomerInvoice::class);
}
}
