<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pagecteare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pageManageTable(){
        $pageCreates = Pagecteare::all();
        return view('admin.setting.pageCreate.pageCreateTable',[
            'pageCreates' =>$pageCreates
        ]);
    }
    public function pageCreateForm(){
        return view('admin.setting.pageCreate.pageCreateForm');
    }
    public function newPageCreate(Request $request){
        $data = array();
        $data['page_position']= $request->page_position;
        $data['page_name']  = $request->page_name;
        $data['page_title']= $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['page_slug'] = Str::slug($request->page_name,'-');
        Pagecteare::insert($data);
        $notification = array('messege'=>'New Page Successfully Created','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function pageEdit($id){
        $pageCreate = Pagecteare::find($id);
        return view('admin.setting.pageCreate.pageEdit',[
            'pageCreate' =>$pageCreate
        ]);
    }

    public function pageUpdate(Request $request,$id){
        $data = array();
        $data['page_position']= $request->page_position;
        $data['page_name']  = $request->page_name;
        $data['page_title']= $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['page_slug'] = Str::slug($request->page_name,'-');
        DB::table('pagecteares')->where('id',$id)->update($data);
        $notification = array('messege'=>'Page Update Successfully','alert-type'=>'info');
        return redirect()->back()->with($notification);
    }

    public function pageDelete($id){
        $pageCreate = Pagecteare::find($id);
        $pageCreate->delete();
        $notification = array('messege'=>'Your Page Successfully Deleted','alert-type'=>'error');
        return redirect()->back()->with($notification);
    }

}
