<?php

namespace App\Http\Controllers\Admin\Functions;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request){
        Reply::create($request->all());
        return redirect()->back();
    }
}
