<?php

namespace App\Http\Controllers\User\Functions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HouseImage;

class HouseImageController extends Controller
{
    public function destroy($id)
    {
        $image = HouseImage::find($id);
        if( $image  == null ){
            return back()->with('error', "ảnh không tồn tại");
        };
        $image->deleteFileAndModel();

        return back()->with('status', "xóa ánh thành công");
    }
}
