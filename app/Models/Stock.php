<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    public  function categories(){
        return $this->belongsTo(Category::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }

}