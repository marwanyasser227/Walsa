<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserAddress;
use App\Models\Shipment;
use App\Models\ActivityLog;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //! 001 => Set the columns can user modifiy in model

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'jobTitle',
        'profileImage'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    //! 002 => Set the Protected hidden column that the application can not view without specific return funciton

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    //! 003 => set Elqouent Realtions between Models
    public function addresses(){
    return $this->hasMany(UserAddress::class);

    } //^ Realtion with Governate table

    public function shipments(){
    return $this->hasMany(Shipment::class);

    } //^ Realtion with Governate table


    public function activityLogs()
    {
    return $this->hasMany(ActivityLog::class);
    
    }//^ Relationship with ActivityLog

}
