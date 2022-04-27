<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \routes\web;

class Needsregister extends Model
{
    use HasFactory;


//★
    /**
     * IDから一件のデータを取得する
     */
    public function getneedsregister($id)
    {
        // 「SELECT id, name, email WHERE id = ?」を発行する
        $query = $this->select([
            'name',
            'number',
            'datetime'
        ])->where([
            'id' => $id
        ]);
        // first()は1件のみ取得する関数
        return $query->first();
    }
}