<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotice extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $attributes = [
        'viewed' => false,
    ];
    public function user(){
        $user = $this->belongsTo(User::class);
        return $user;
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
