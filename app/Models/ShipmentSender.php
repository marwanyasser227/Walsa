<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;
use App\Models\City;
use App\Models\ActivityLog;

class ShipmentSender extends Model
{
    use HasFactory;

      //! 001 => Set the columns can user modifiy in model
      public $fillable = [
        'name',
        'email',
        'phone',
        'secondPhone' ,
        'street',
        'city_id',
        'bulid_Number',
        'appartement',
        'floor',
        'createAccount'
    ];

    //! 002 => Set the Protected hidden column that the application can not view without specific return funciton
    public function shipments(){
        return $this->hasMany(Shipment::class);

    }//^ Realtion with Shipment table

    public function city(){
        return $this->belongsTo(City::class);

    }//^ Realtion with City table

     public function activityLogs()
     {
         return $this->hasMany(ActivityLog::class);

     }//^ Realtion with ActivityLog table
}
