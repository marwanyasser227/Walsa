<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Governate;
use App\Models\Address;
use App\Models\ShipmentReciver;
class City extends Model
{
    use HasFactory;

    //! 001 => Set the columns can user modifiy in model
    public $fillable = [
        'name',
        'governate_id',
    ];

    //! 002 => set Elqouent Realtions between Models
    public function governate(){
        return $this->belongsTo(Governate::class);
    } //^ Realtion with Governate table


    public function address (){
        return $this->hasMany(Address::class);

    } //^ Realtion with Address table

    public function recivers(){
        return $this->belongsTo(ShipmentReciver::class ,'city_id');
        
     }//^ Realtion with Reciver table
}
