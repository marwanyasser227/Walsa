<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    
     //! 001 => Set the columns can user modifiy in model
     public $fillable = [
        'name',
        'image',
    ];

}
