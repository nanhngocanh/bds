<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'phone',
    ];

    public function image(){
        $image = $this->hasOne(AdminAvatar::class);
        return $image;
    }

    public function adminAccount(){
        $admin_account = $this->hasOne(AdminAccount::class);
        return $admin_account;
    }
}
