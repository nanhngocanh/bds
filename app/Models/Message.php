<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'message_type_id',
        'house_id',
        'user_id',
        'sloving'
    ];

    protected $attributes = [
        'sloving' => false,
    ];

    public function user_send(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function user_rec(){
        return $this->belongsTo(House::class,'house_id');
    }

    public function type (){
        return $this->belongsTo(MessageType::class,'message_type_id');
    }

    public function scopeHandlerOrder($query){
        return $query->orderBy('id');
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
