<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Employee extends Model
{
    use HasFactory;

    public static function getEmployeeNameAttribute()
    {
        return "employee_name_" . App::getLocale();
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
