<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function seoForm(){
       $seo = DB::table('seos')->first();
        return view('admin.setting.seoForm', [
            'seo'=>$seo
            ]);
    }

    public function seoUpdate(Request $request,$id){
        $data = array();
        $data['meta_title']                = $request->meta_title;
        $data['meta_author']            = $request->meta_author;
        $data['meta_tag']                  =$request->meta_tag;
        $data['meta_description']    =$request->meta_description;
        $data['meta_keyword']         =$request->meta_keyword;
        $data['google_verification'] =$request->google_verification;
        $data['google_analytics']      =$request->google_analytics;
        $data['google_adsense']        =$request->google_adsense;
        $data['alexa_verification']    =$request->alexa_verification;

//        Seo::find($request->id)->update($data);
        DB::table('seos')->where('id',$id)->update($data);
        $notification =array('messege' =>'Seo Setting Successfully Update','alert-type'=>'success');
        return redirect()->back()->with($notification);

    }



}
