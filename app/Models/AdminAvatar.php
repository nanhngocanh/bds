<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class AdminAvatar extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function deleteFileAndModel(){

        $image_name = $this->image;
        if(File::exists(public_path('storage/image/'.$image_name))){
            File::delete(public_path('storage/image/'.$image_name));
        }
        $this->delete();
    }
}
