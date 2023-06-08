<?php

namespace App\Http\Controllers\Admin\Functions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::handlerOrder()->search()->paginate(5);
        return view('admin.function.users.index', compact('users'));
    }

    public function unblock($id)
    {
        try {
            $state = User::where('id', $id)->update(['block_state' => false]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('error', 'Error unblock user');
        }
        return redirect()->back()->with('status', 'Unblock user successful');
    }

    public function block($id)
    {
        try {
            $tate = User::where('id', $id)->update(['block_state' => true]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('error', 'Error block user');
        }
        return redirect()->back()->with('status', 'Block user successful');
    }
}
