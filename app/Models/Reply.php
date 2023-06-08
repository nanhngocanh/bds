<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'message_id',
        'admin_id',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
