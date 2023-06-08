<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\UserAvatar;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // register with get method
    public function register()
    {
        return view('user.auth.register');
    }

    // register with post methof
    public function store(Request $request)
    {

        $request->flash();

        $userInfo = $request->only(['fullname', 'email', 'phone']);

        if ($request->input('password') === $request->input('cfpassword')) {

            $user = UserAccount::where([
                'username' => $request->input('username'),
            ])->first();

            if ($user) {
                return redirect()->back()->with('error', 'Username already exist');
            } else {


                $user = User::create($userInfo);

                UserAccount::create([
                    'user_id' => $user->id,
                    'username' => $request->input('username'),
                    'password' => bcrypt($request->input('password')),
                ]);

                if ($request->has('avatar')) {
                    $image = $request->file('avatar');
                    $image_name = 'user'.$request->username . time() . rand(1, 1000) . '.' . $image->extension();
                    $image->move(public_path('storage/image'), $image_name);
                    UserAvatar::create([
                        'user_id' => $user->id,
                        'image' => $image_name,
                    ]);
                }

                return redirect()->route("login")->with('status', 'Successful');
            }

        } else {
            return redirect()->back()->with('error', 'Password and confirm passwrod not match');
        }

    }
}
