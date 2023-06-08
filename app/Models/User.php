<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'email',
        'phone',
    ];

    protected $attributes = [
        'block_state' => false,
    ];

    public function message (){
        return $this->hasManyThrough(Message::class, House::class,'user_id', 'house_id');
    }

    public function house (){
        return $this->hasMany(House::class,'user_id');
    }

    public function book (){
        return $this->hasMany(Bookmark::class,'user_id');
    }
    public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('fullname', 'like', '%'.$key.'%')->orWhere('email', 'like', '%'.$key.'%')->orWhere('phone', 'like', '%'.$key.'%');
        }
        return $query;
    }

    public function scopeHandlerOrder($query){
        $query = $query->orderBy('id');
        return $query;
    }

    public function image(){
        $image = $this->hasOne(UserAvatar::class);
        return $image;
    }

    public function userAccount(){
        $user_account = $this->hasOne(UserAccount::class);
        return $user_account;
    }
}
