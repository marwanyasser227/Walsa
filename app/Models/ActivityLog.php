<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ShipmentSender;
class ActivityLog extends Model
{
    use HasFactory;

    //! 001 => push accessable data to model
    protected $fillable = [
        'user_id',
        'action',
        'details',
        'sender_id',
    ];


    //! 002 => set relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }//^ Realtion with User table

    public function sender()
    {
        return $this->belongsTo(ShipmentSender::class);
    }//^ Realtion with Sender table
}
