<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = [
        'sitter_id',
        'customer_id' ,
        'from',
        'to',
        'hoursPerDay',
        'phone',
        'address',
        'proposal',
    ];
}
