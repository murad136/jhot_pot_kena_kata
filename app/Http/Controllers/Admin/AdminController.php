<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function AdminHomePage(){
        return view('admin.adminHomePage');
    }

    public function AdminLogOut(){
        Auth::logout();
        $notification = array('messege'=>'You Are Successfully Logout','alert-type'=>'success');
        return redirect()->route('admin_login')->with($notification);
    }


public function PasswordReset(){
        return view('admin.password.passwordReset');
}



    public function PasswordUpadate(Request $request){

        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $current_password = Auth::user()->password;
        $old_pass  =$request->old_password;
        $new_pass =$request->password;
        if (Hash::check($old_pass,$current_password)){
                $user = User::findorfail(Auth::id());
                $user->password= Hash::make($request->password);
                $user->save();
                Auth::logout();
                $notification = array('messege' => 'Your Password Successfully Update','alert-type'=>'success');
                return redirect()->route('admin_login')->with($notification);
        }else{
            $notification = array('messege' => 'Your old password does not match','alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

    }
}
