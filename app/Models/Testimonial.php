<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    //! 001 => set access data to insert or modifiy in model
    public $fillable = [
        'name' , 'jobTitle' , 'image' , 'message'
    ];
}
