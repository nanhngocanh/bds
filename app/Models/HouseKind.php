<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseKind extends Model
{
    use HasFactory;
    protected $fillable = [
        'kind',
    ];

    public function house (){
        return $this->hasMany(House::class, 'house_kind_id');
    }
}
