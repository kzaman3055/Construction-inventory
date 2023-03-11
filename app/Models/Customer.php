<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'email', 'mobile',  'address','square_feet' ,'estimation','advance_amount' ,

    ];

}
