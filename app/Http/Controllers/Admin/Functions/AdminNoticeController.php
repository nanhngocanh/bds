<?php

namespace App\Http\Controllers\Admin\Functions;

use App\Events\NoticeEvent;
use App\Http\Controllers\Controller;
use App\Models\AdminNotice;
use Illuminate\Http\Request;

class AdminNoticeController extends Controller
{
    public function index(){
        $notices = AdminNotice::latest()->get();
        return $notices;
    }

    public function store($request){
        AdminNotice::create($request);
        NoticeEvent::dispatch($request);
    }

    public function update($id){
        AdminNotice::where('id', $id)->update(['viewed' => true]);
    }

    public function count(){
        $count = AdminNotice::count();
        return $count;
    }
}
