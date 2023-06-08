<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function edit(Request $request){

        $user = User::where('id', Auth::user()->user_id)->first();
        $account = UserAccount::where('user_id',$user->user_id);
        if($request->getMethod() == 'GET'){
            return view('user.manage.profile', ['user' => $user,'account'=>$account]);
        }
        if ($request->newpassword == null)
        {
            $user = UserAccount::where([
                ['username', $request->input('username')],
                ['user_id', '!=', Auth::user()->user_id],
            ])->first();

            if($user){
                return redirect()->back()->withInput([
                    'user' => $user,
                ])->with('status', 'Username already exist');
            }

            if( Hash::check($request->input('current_password'), Auth::user()->password) ){

                $user = $request->only(['fullname', 'email', 'phone']);
                User::where('id', Auth::user()->user_id)->update($user);

                $user = UserAccount::find(Auth::user()->user_id);

                Auth::login($user);

                return redirect()->back()->withInput([
                    'user' => $user,
                ])->with('status', 'Successful');
            }else{
                return redirect()->back()->withInput([
                    'user' => $user,
                ])->with('error', 'Current password is invalid');
            }
        }
        elseif ($request->input('new_password') === $request->input('confirm_password')) {
            $user = UserAccount::where([
                ['username', $request->input('username')],
                ['user_id', '!=', Auth::user()->user_id],
            ])->first();

            if($user){
                return redirect()->back()->withInput([
                    'user' => $user,
                ])->with('status', 'Username already exist');
            }

            if( Hash::check($request->input('current_password'), Auth::user()->password) ){

                $user = $request->only(['fullname', 'email', 'phone']);
                User::where('id', Auth::user()->user_id)->update($user);

                UserAccount::where('user_id', Auth::user()->user_id)->update([
                    'password' => bcrypt($request->input('new_password')),
                ]);

                $user = UserAccount::find(Auth::user()->user_id);

                Auth::login($user);

                return redirect()->back()->withInput([
                    'user' => $user,
                ])->with('status', 'Successful');
            }else{
                return redirect()->back()->withInput([
                    'user' => $user,
                ])->with('error', 'Current password is invalid');
            }

        } else {
            return redirect()->back()->withInput([
                'user' => $user,
            ])->with('error', 'New password and confirm passwrod not match');
        }
    }

    public function destroy($id){
        $user = User::find($id);
        //dd($house);
        try {
            $user = User::find($id);
            //dd($house);
            User::where('id', $id)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with("error", "Xoa tài that bai");
        }
        return redirect()->route('login');
    }
}
