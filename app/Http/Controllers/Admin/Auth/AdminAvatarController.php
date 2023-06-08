<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

use App\Models\AdminAvatar;
use Illuminate\Http\Request;

class AdminAvatarController extends Controller
{
    public function destroy($id)
    {
        $image = AdminAvatar::find($id);
        if( $image  == null ){
            return back()->with('error', "ảnh không tồn tại");
        };
        $image->deleteFileAndModel();

        return back()->with('status', "xóa ánh thành công");
    }
}
