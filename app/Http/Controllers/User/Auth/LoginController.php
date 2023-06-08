<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserAccount;
use App\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('user.auth.login');
        }

        $credentials = $request->only(['username', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->route('manage.post');
        } else {
            $request->flash();
            return redirect()->back()->with('error', 'Usename password is invaid');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function edit_profile(Request $request)
    {

        $userInfo = User::where('id', Auth::user()->user_id)->first();

        if ($request->getMethod() == 'GET') {
            return view('user.function.edit_profile', ['userInfo' => $userInfo]);
        }

        if ($request->input('new_password') === $request->input('confirm_password') || $request->has('new_password') == false) {

            $user = UserAccount::where([
                ['username', $request->input('username')],
                ['user_id', '!=', Auth::user()->user_id],
            ])->first();

            if ($user) {
                return redirect()->back()->withInput([
                    'userInfo' => $userInfo,
                ])->with('status', 'Username already exist');
            }

            if (Hash::check($request->input('current_password'), Auth::user()->password)) {

                $userInfo = $request->only(['fullname', 'email', 'phone']);
                User::where('id', Auth::user()->user_id)->update($userInfo);


                if ($request->has('avatar')) {
                    $image = $request->file('avatar');
                    $image_name = 'user'.$request->username . time() . rand(1, 1000) . '.' . $image->extension();
                    $image->move(public_path('storage/image'), $image_name);
                    UserAvatar::create([
                        'user_id' => Auth::user()->user_id,
                        'image' => $image_name,
                    ]);
                }

                if ($request->new_password != null) {
                    UserAccount::where('user_id', Auth::user()->user_id)->update([
                        'username' => $request->username,
                        'password' => bcrypt($request->input('new_password')),
                    ]);
                }
                $user = UserAccount::find(Auth::user()->user_id);

                Auth::login($user);

                return redirect()->back()->withInput([
                    'userInfo' => $userInfo,
                ])->with('status', 'Successful');
            } else {
                return redirect()->back()->withInput([
                    'userInfo' => $userInfo,
                ])->with('error', 'Current password is invalid');
            }

        } else {
            return redirect()->back()->withInput([
                'userInfo' => $userInfo,
            ])->with('error', 'New password and confirm passwrod not match');
        }
    }
}
