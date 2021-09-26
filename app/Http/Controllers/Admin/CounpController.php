<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CounpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function coupnForm(Request $request){
        if ($request->ajax()){
            $coupns = Coupn::all();
            return DataTables::of($coupns)
                ->addIndexColumn()
                ->addColumn('action',function ($coupn){
                    $actionBtn = '<a href="#" class="btn btn-sm btn-info edit" data-id="'.($coupn->id).'" data-toggle="modal" data-target="#editCoupn"> <span class="fa fa-edit"></span></a>
                            <a href=" '.route('coupnDelete',[$coupn->id]).' " class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>';
                     return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.coupn.coupnForm');
    }

    public function coupnInsert(Request $request){
        $data = array(
            'coupn_code'      => $request->coupn_code,
            'coupn_type'       => $request->coupn_type,
            'coupn_amount' => $request->coupn_amount,
            'valid_date'         => $request->valid_date,
            'coupn_status'    => $request->coupn_status
        );
        Coupn::insert($data);
        $notification = array('messege'=>'Coupn  Successfully Inserted!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function Edit($id){
        $coupn = Coupn::find($id);
        return view('admin.coupn.Edit',[
            'coupn'=>$coupn
        ]);
    }


    public function coupnUpdate(Request $request){
        $data = array(
            'coupn_code'      => $request->coupn_code,
            'coupn_type'       => $request->coupn_type,
            'coupn_amount' => $request->coupn_amount,
            'valid_date'         => $request->valid_date,
            'coupn_status'    => $request->coupn_status
        );
        DB::table('coupns')->where('id',$request->id)->update($data);
        $notification = array('messege'=>'Coupn  Successfully Updated!','alert-type'=>'info');
        return redirect()->back()->with($notification);
    }


    public function coupnDelete($id){
        $coupn = Coupn::find($id);
        $coupn->delete();
        $notification = array('messege'=>'Coupn  Successfully Deleted!','alert-type'=>'error');
        return redirect()->back()->with($notification);
    }

}
