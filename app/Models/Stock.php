<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\StockControllers;
use Carbon\Carbon;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $fillable = [
        'stock_item_name',
        'quantity',
        'alert_number',
        'stock_expiration',
        'alert_number'
    ];
    /**
     * 在庫を保持するユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
      protected $dates = [
        'stock_expiration',
    ];
}