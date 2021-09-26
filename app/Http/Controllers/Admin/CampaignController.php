<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function campaignTable(Request $request){
        if ($request->ajax()){
            $campaigns = DB::table('campaigns')->orderBy('id','DESC')->get();
            return DataTables::of($campaigns)
                    ->addIndexColumn()
                    ->editColumn('status',function ($campaign){
                        if ($campaign->status){
                          return '<a href="#"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-success">Active</span></a>';
                        }else{
                            return '<a href="#"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-danger">Deactive</span></a>';
                        }
                    })
                    ->addColumn('action',function ($campaign){
                        $actionBtn = '<a href="#" class="btn btn-sm btn-info edit" data-id="'.($campaign->id).'" data-toggle="modal" data-target="#editCampaing"> <span class="fa fa-edit"></span></a>
                                                <a href="'.route('campaignDelete',[$campaign->id]).'" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>';
                        return $actionBtn;
                    })
                   ->rawColumns(['action','status'])
                   ->make('true');
        }
        return view('admin.campaign.campaignTable');
    }




    public function AddCampaign(Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:campaigns|max:55',
            'campaign_img' => 'required',
            'start_date' => 'required',
        ]);

        $data = array();
        $data['title']                    = $request->title;
        $data['start_date']          = $request->start_date;
        $data['end_date']            = $request->end_date;
        $data['discount']             = $request->discount;
        $data['status']                  = $request->status;
        $data['month']                 = date('F');
        $data['year']                     = date('Y');

        $photo = $request->campaign_img;
        $slug = Str::slug($request->title,'-');
        $photoName =$slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(140,120)->save('admin/campaing_imgs/'.$photoName);
        $data['campaign_img']   = 'admin/campaing_imgs/'.$photoName;
        Campaign::insert($data);
        $notification = array('messege'=>'Campaign Information Successfully Submited','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function EditCampaign($id){
        $campaign = Campaign::find($id);
        return view('admin.campaign.edit',[
            'campaign' =>$campaign
        ]);
    }


    public function UpdateCampaign(Request $request){
        $data = array();
        $data['title']                    = $request->title;
        $data['start_date']          = $request->start_date;
        $data['end_date']            = $request->end_date;
        $data['discount']             = $request->discount;
        $data['status']                  = $request->status;
        $data['month']                 = date('F');
        $data['year']                     = date('Y');

        if ($request->campaign_img){
            if (File::exists($request->old_campaign)) {
                unlink($request->old_campaign);
                     }
            $photo = $request->campaign_img;
            $slug = Str::slug($request->title,'-');
            $photoName =$slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(140,120)->save('admin/campaing_imgs/'.$photoName);
            $data['campaign_img']   = 'admin/campaing_imgs/'.$photoName;
            DB::table('campaigns')->where('id',$request->id)->update($data);
            $notification = array('messege'=>'Campaign Information Successfully Updated.!','alert-type'=>'info');
            return redirect()->back()->with($notification);
        }else{
            $data['campaign_img']   = $request->old_campaign;
            DB::table('campaigns')->where('id',$request->id)->update($data);
            $notification = array('messege'=>'Campaign Information Successfully Submited','alert-type'=>'info');
            return redirect()->back()->with($notification);
        }
    }



    public function DeleteCampaign($id){
        $campaign = Campaign::find($id);
        $img = $campaign->campaign_img;
        if (File::exists($img)){
                unlink($img);
        }
        $campaign->delete();
        $notification = array('messege'=>'Campaign Successfully Deleted','alert-type'=>'error');
        return redirect()->back()->with($notification);
    }

}
