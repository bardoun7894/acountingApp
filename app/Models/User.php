<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    public function supplierInvoices(){
        return $this->hasMany(SupplierInvoice::class);
    }
static public function getFullnameLang(){
    $full_name ="full_name_".Translation::getLang();
    return $full_name;
}
    static public function getFullName($lang){
        $full_name ="full_name_".$lang;
        $fullname=Auth::user()->$full_name;
        return $fullname;
    }
}
