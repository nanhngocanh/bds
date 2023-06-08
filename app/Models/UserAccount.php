<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UserAccount extends Authenticatable
{
    use HasFactory;
    protected $table = 'user_accounts';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'username',
        'password',
    ];
}
