<?php

namespace App\Http\Controllers\Admin\Functions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Functions\UserNoticeController;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::handlerOrder()->paginate(10);
        return view('admin.function.messages.index', compact("messages"));
    }

    public function solve($id){
        $message = Message::where('id', $id)->first();

        if($message->sloving == true){
            Message::where('id', $id)->update(['sloving' => false]);
        }else{
            Message::where('id', $id)->update(['sloving' => true]);
        }
        $notice = [
            'title' => "Message được giải quyết ",
            'message' => $message->content,
            'src' => route('user.message.show', ['id' => $id]),
            'user_id' => $message->user_id,
            'admin_id' => auth('admin')->user()->admin_id,
        ];
        (new UserNoticeController)->store($notice);
        return redirect()->route('admin.message.index')->with('status', 'Cập nhật thành công');
    }

    public function show($id){
        $message = Message::where('id', $id)->first();
        return view('admin.function.messages.show', compact('message'));
    }

    public function count(){
        $count = Message::count();
        return $count;
    }


}
