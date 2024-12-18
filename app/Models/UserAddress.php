<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\City;

class UserAddress extends Model
{
    use HasFactory;

     //! 001 => Set the columns can user modifiy in model
     public $fillable = [
            'street',
            'user_id',
            'city_id',
            'bulid_Number',
            'appartement',
            'floor',
            'secondPhone',
            'postCode',
            'isMain',

        ];


      //! 002 => set Elqouent Realtions between Models
      public function user(){
        return $this->belongsTo(User::class);

    }//^ Relationship with User

    public function city (){
        return $this->belongsTo(City::class);

    }//^ Relationship with City
}
