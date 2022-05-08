<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\stocksControllers;
use Carbon\Carbon;

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
    public function user(){
        return $this->belongsTo('App\User');
      }
      protected $dates = [
        'stock_expiration',
    ];
}