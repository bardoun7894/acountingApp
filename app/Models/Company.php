<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    static function getCompanyNameLang()
    {
        return "company_name_" . app()->getLocale();
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
