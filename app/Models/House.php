<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'house_state_id',
        'house_type_id',
        'house_kind_id',
        'sell_state',
        'furniture',
        'livingroom',
        'kitchen',
        'toilet',
        'bedroom',
        'bathroom',
        'city',
        'district',
        'commune',
        'address',
        'images',
        'size',
        'desciption',
        'price',
    ];

    protected $attributes = [
        'sell_state' => false,
        'post_state' => false,
        'images' => '',
        'house_state_id' => 1,
    ];

    public function user (){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kind (){
        return $this->belongsTo(HouseKind::class, 'house_kind_id');
    }

    public function type (){
        return $this->belongsTo(HouseType::class, 'house_type_id');
    }

    public function bookmark (){
        return $this->belongsTo(Bookmark::class,'house_id', 'id');
    }

    public function scopeHandlerOrder($query){
        $query = $query->orderBy('id');
        return $query;
    }

    public function scopeSearch($query){
        if($post_state = request()->post_state){
            $query = $query->where("post_state", $post_state);
        }
        return $query;
    }

    public function imagess (){
        $images = $this->hasMany(HouseImage::class);
        return $images;
    }

}
