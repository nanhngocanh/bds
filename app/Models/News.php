<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Array_;

class News extends Model
{
    use HasFactory;

    protected $table = "news";

    protected $guarded = [];

    protected $fillable = [
        'title',
        'content',
        'auther',
        'admin_id',
    ];

    public function imagess(){
        $images = $this->hasMany(Image::class);
        return $images;
    }
    public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('title', 'like', '%'.$key.'%')->orWhere('auther', 'like', '%'.$key.'%')->orWhere('id', 'like', '%'.$key.'%');
        }
        return $query;
    }

    public function scopeHandlerOrder($query){
        $query = $query->orderBy('id');
        return $query;
    }
}
