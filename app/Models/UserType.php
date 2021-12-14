<?php

namespace App\Models; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
     

    //create a relationship between user and usertype
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
 
   
}
