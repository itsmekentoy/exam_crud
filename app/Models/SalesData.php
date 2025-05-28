<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{
    protected $table = 'sales_data';

    protected $fillable = [
        'salesperson_name',
        'item_a',
        'item_b',
        'item_c',
        'item_d',
    ];

    public $timestamps = true;

    
}
