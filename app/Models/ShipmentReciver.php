<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;
use App\Models\City;

class ShipmentReciver extends Model
{
    use HasFactory;

     //! 001 => Set the columns can user modifiy in model
      public $fillable = [
        'name','email','phone','secondPhone','city_id','bulid_Number','appartement','street','floor'
    ];

     //! 002 => Set the Protected hidden column that the application can not view without specific return funciton

     public function shipments(){
        return $this->hasMany(shipment::class );

    }//^ Realtion with Shipment table

     public function city(){
        return $this->belongsTo(City::class);

     }//^ Realtion with City table
}
