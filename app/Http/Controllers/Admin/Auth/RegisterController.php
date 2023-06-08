<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminAccount;
use App\Models\AdminAvatar;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    // register with get method
    public function register()
    {
        return view('admin.auth.register');
    }

    // register with post methof
    public function store(Request $request)
    {

        $data = $request->except('_token');

        $request->flash();

        if ($request->input('password') === $request->input('cfpassword')) {

            $admin = AdminAccount::where([
                'username' => $request->input('username'),
            ])->first();

            if ($admin) {
                array_push($data, 'status', 'Username already exist');
                return redirect()->route('admin.register')->with('status', 'Username already exist');
            } else {

                $adminInfo = $request->only(['fullname', 'email', 'phone']);

                $admin = Admin::create($adminInfo);

                AdminAccount::create([
                    'admin_id' => $admin->id,
                    'username' => $request->input('username'),
                    'password' => bcrypt($request->input('password')),
                ]);


                if ($request->has('avatar')) {
                    $image = $request->file('avatar');
                    $image_name = 'admin'.$request->username . time() . rand(1, 1000) . '.' . $image->extension();
                    $image->move(public_path('storage/image'), $image_name);
                    AdminAvatar::create([
                        'admin_id' => $admin->id,
                        'image' => $image_name,
                    ]);
                }
                return redirect()->route('admin.login')->with('status', 'Successful');
            }

        } else {
            return redirect()->route('admin.register')->with('status', 'Password and confirm passwrod not match');
        }

    }
}
