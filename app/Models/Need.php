<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'date_of_purchase'];

    /**
     * 買い物リストを保持するユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
