<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotice extends Model
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
}
