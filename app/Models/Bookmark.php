<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'house_id',
    ];

    public function house (){
        return $this->hasOne(House::class,'house_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
