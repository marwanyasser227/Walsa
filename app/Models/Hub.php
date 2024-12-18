<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Map;
class Hub extends Model
{
    use HasFactory;

    //! 001 => Set Fillable data
    public $fillable = [
        'name_ar',
        'address',
        'city_id',
    ];

    //! 002 => Set Elqouent Relations
    public function city(){
        return $this->belongsTo(City::class);
    }//^ Realtion with City model

    public function map(){
        return $this->hasOne(Map::class);
    }//^ Realtion with City model
}
