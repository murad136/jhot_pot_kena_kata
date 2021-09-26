<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebSeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class WebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function webSetting(){
        $webSetting = DB::table('web_setings')->first();
        return view('admin.setting.webSetting',[
            'webSetting'=>$webSetting
        ]);
    }


    public function SettingUpdate(Request $request,$id){
        $data = array();
        $data['currency']             = $request->currency;
        $data['phone_one']        = $request->phone_one;
        $data['phone_two']        = $request->phone_two;
        $data['main_email']       = $request->main_email;
        $data['support_email']   = $request->support_email;
        $data['address']               = $request->address;
        $data['facebook']            = $request->facebook;
        $data['youtube']             = $request->youtube;
        $data['instagram']          = $request->instagram;
        $data['twitter']               = $request->twitter;
        $data['linkdin']              = $request->linkdin;
            if ($request->logo){
                $logo = $request->logo;
                $logoName =uniqid().'.'.$logo->getClientOriginalExtension();
                Image::make($logo)->resize(120,140)->save('photos/setting/'.$logoName);
                $data[	'logo']='photos/setting/'.$logoName;
            }else{
            $data[	'logo']=$request->old_logo;
            }

            if ($request->favicon){
                $favicon = $request->favicon;
                $faviconName =uniqid().'.'.$favicon->getClientOriginalExtension();
                Image::make($favicon)->resize(120,140)->save('photos/setting/'.$faviconName);
                $data['favicon']='photos/setting/'.$faviconName;
            }else{
            $data['favicon']=$request->old_favicon;
            }

            DB::table('web_setings')->where('id',$id)->update($data);
            $notification = array('messege'=>'Web Setting Update Successfully','alert-aype'=>'success');
            return redirect()->back()->with($notification);

    }

}
