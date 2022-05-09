<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','need_item_name', 'quantity', 'date_of_purchase'];

    /**
     * 買い物リストを保持するユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
