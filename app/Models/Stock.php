<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\stocksControllers;
use App\Models\Flight;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $fillable = [
        'id',
        'user_id',
        'stock_item_name',
        'quantity',
        'stock_expiration',
    ];

    
}
