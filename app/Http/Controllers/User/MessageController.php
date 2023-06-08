<?php

namespace App\Http\Controllers\User;

use App\Events\NoticeEvent;
use App\Http\Controllers\Admin\Functions\AdminNoticeController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\MessageType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index (){
        $messages = Message::handlerOrder()->where('user_id', auth()->user()->user_id)->paginate(10);
        return view('user.mess.index',compact("messages"));
    }

    public function destroy($id){
        try {
            $mess = Message::find($id);
            Message::where('id', $id)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with("error", "Xoa tin that bai");
        }
        return redirect()->route('message')->with("status", "Xoa tin thanh cong");
    }


    // public function delet($id){

    //     DB::delete('Delete from messages where id = ?',[$id]);
    //     return redirect() ->route('message');
    //     //return redirect()->route('message');
    //     //return view ('user.mess.message');
    // }

    public function detail($id){
        $mess = DB::select('select * from messages inner join houses on messages.house_id = houses.id where messages.id = ?', [$id]);
        if ($mess[0]->message_type_id == 2) {
            $temp = DB::select('select * from users inner join messages on users.id = messages.user_id where messages.id = ?', [$id]);
            return view('user.mess.contact_message',compact('temp'));
        } else {
            $temp = DB::select('select messages.created_at, projects.name, projects.id, address, messages.content
            from (messages inner join houses on messages.house_id = houses.id)
            inner join projects on houses.project_id = projects.id where messages.id = ?', [$id]);
            //dd($temp);
            return view('user.mess.report_message',compact('temp'));
        }
    }

    public function create(){
        return view('user.mess.create');
    }

    public function store(Request $request){
        $param = $request->only([
            'content',
            'message_type_id',
            'house_id',
            'user_id'
        ]);
        $message = Message::create($param);

        $notice = [
            'title' => "Có liên hệ đến admin",
            'message' => $request->content,
            'src' => route('admin.message.show', ['id' => $message]),
            'user_id' => auth()->user()->user_id,
        ];
        (new AdminNoticeController)->store($notice);
        return redirect()->route('message')->with('status', "tạo lên hệ thành công");
    }

    public function show($id){
        $message = Message::where('id', $id)->first();
        return view('user.mess.show', compact('message'));
    }
}
