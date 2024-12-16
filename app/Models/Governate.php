<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Area;
class Governate extends Model
{
    use HasFactory;
     //! 001 => Set the columns can user modifiy in model
     public $fillable = [
        'name',
        'area_id',
     ];

     //! 002 => set Elqouent Realtions between Models
     public function cities(){
        return $this->hasMany(City::class);
    }
     public function area(){
        return $this->belongsTo(Area::class);
    }
}
