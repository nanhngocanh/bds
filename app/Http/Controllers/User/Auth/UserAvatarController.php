<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;

use App\Models\UserAvatar;
use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
    public function destroy($id)
    {
        $image = UserAvatar::find($id);
        if( $image  == null ){
            return back()->with('error', "ảnh không tồn tại");
        };
        $image->deleteFileAndModel();

        return back()->with('status', "xóa ánh thành công");
    }
}
