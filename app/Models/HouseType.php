<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
    ];

    public function house (){
        return $this->hasMany(House::class, 'house_type_id');
    }
}
