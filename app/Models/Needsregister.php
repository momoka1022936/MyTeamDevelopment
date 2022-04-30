<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \routes\web;

class Needsregister extends Model
{
    use HasFactory;
    protected $table = 'needs';
    protected $fillable = [
        'user_id',
        'need_item_name',
        'quantity',
        'date_of_purchase',
    ];
}    