<?php

namespace App\Http\Controllers\User\Functions;

use App\Events\NoticeEvent;
use App\Http\Controllers\Controller;
use App\Models\UserNotice;
use Illuminate\Http\Request;

class UserNoticeController extends Controller
{
    public function index(){
        $notices = UserNotice::where('user_id', auth()->user()->user_id)->latest()->get();
        return $notices;
    }

    public function store($request){
        UserNotice::create($request);
        NoticeEvent::dispatch($request);
    }

    public function update($id){
        UserNotice::where('id', $id)->update(['viewed' => true]);
    }

    public function count(){
        $count = UserNotice::where('user_id', auth()->user()->user_id)->count();
        return $count;
    }
}
