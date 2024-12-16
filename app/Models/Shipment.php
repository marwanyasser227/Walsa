<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Models\User;
use App\Models\ShipmentReciver;
use App\Models\ShipmentSender;

class Shipment extends Model
{
    use HasFactory;
    //! 001 => Set the columns can user modifiy in model

    public $fillable = [
        'trackNumber','itemSize','itemType','shipmentType','user_id','collectMoney' , 'collectedPrice','shipment_reciver_id','shipment_sender_id' ,'shipment_costs'
    ];

    //! 002 => Set the Protected hidden column that the application can not view without specific return funciton
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reciver(){
        return $this->belongsTo(ShipmentReciver::class , 'shipment_reciver_id');
    }

    public function sender(){
        return $this->belongsTo(ShipmentSender::class , 'shipment_sender_id' );
    }

    //! 003 => use Notifications
    use Notifiable;

}
