<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmtpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function smtpForm(){
        $smtp = DB::table('smtps')->first();
        return view('admin.setting.smtpForm',[
            'smtp'=>$smtp
        ]);
    }

    public function smtpUpdate(Request $request,$id){
        $data = array();
        $data['mailer']         = $request->mailer;
        $data['host']             = $request->host;
        $data['port']             = $request->port;
        $data['user_name'] = $request->user_name;
        $data['password']    = $request->password;

        DB::table('smtps')->where('id',$id)->update($data);
        $notification = array('messege' => 'SMTP Setting Successfully Update','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
