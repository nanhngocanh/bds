<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminAccount;
use App\Models\AdminAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.auth.login');
        }

        $credentials = $request->only(['username', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            $request->flash();
            return redirect()->back()->with('error', 'Usename password is invaid');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }

    public function edit_profile(Request $request){

        $adminInfo = Admin::where('id', Auth::guard('admin')->user()->admin_id)->first();

        if($request->getMethod() == 'GET'){
            return view('admin.auth.edit_profile', ['adminInfo' => $adminInfo]);
        }
        if ($request->input('new_password') === $request->input('confirm_password') || $request->has('new_password') == false) {

            $admin = AdminAccount::where([
                ['username', $request->input('username')],
                ['admin_id', '!=', Auth::guard('admin')->user()->admin_id],
            ])->first();


            if($admin){
                return redirect()->back()->withInput([
                    'adminInfo' => $adminInfo,
                ])->with('status', 'Username already exist');
            }

            if( Hash::check($request->input('current_password'), Auth::guard('admin')->user()->password) ){

                $adminInfo = $request->only(['fullname', 'email', 'phone']);
                Admin::where('id', Auth::guard('admin')->user()->admin_id)->update($adminInfo);

                if ($request->has('avatar')) {
                    $image = $request->file('avatar');
                    $image_name = 'admin'.$request->username . time() . rand(1, 1000) . '.' . $image->extension();
                    $image->move(public_path('storage/image'), $image_name);
                    AdminAvatar::create([
                        'admin_id' => Auth::guard('admin')->user()->admin_id,
                        'image' => $image_name,
                    ]);
                }

                if($request->new_password != null){
                    AdminAccount::where('admin_id', Auth::guard('admin')->user()->admin_id)->update([
                        'password' => bcrypt($request->input('new_password')),
                    ]);
                }
                $user = AdminAccount::find(Auth::guard('admin')->user()->admin_id);

                Auth::login($user);

                return redirect()->back()->withInput([
                    'adminInfo' => $adminInfo,
                ])->with('status', 'Successful');
            }else{
                return redirect()->back()->withInput([
                    'adminInfo' => $adminInfo,
                ])->with('error', 'Current password is invalid');
            }

        } else {
            return redirect()->back()->withInput([
                'adminInfo' => $adminInfo,
            ])->with('error', 'New password and confirm passwrod not match');
        }
    }
}
