<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Governate;

class Area extends Model
{
    use HasFactory;
     //! 001 => Set the columns can user modifiy in model
       public $fillable = [
        'name',
        'shipmentPrice',
     ];

     //! 002 => Set Elqouent Realtions between Models
     public function governates(){
        return $this->hasMany(Governate::class);

    }//^ Realtion with Governate table

}
