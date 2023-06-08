<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin;


class AdminAccount extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin_accounts';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'admin_id',
        'username',
        'password',
    ];

    public function admin(){
        $admin = $this->belongsTo(Admin::class, 'admin_id');
        return $admin;
    }
}
