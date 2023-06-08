<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageType extends Model
{
    use HasFactory;
    protected $table = 'message_types';
    protected $fillable = [
        'type',
    ];

    public function Mess (){
        return $this->hasOne(Message::class,'message_type_id');
    }

}
