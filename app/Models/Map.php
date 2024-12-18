<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;
    public $fillable =
    [
        'map','hub_id'
    ];
    public function hub(){
        return $this->belongsTo(Map::class);
    }//^ Realtion with Hub model

}
