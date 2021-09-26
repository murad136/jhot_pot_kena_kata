<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        public function pickupForm(Request $request){
            if ($request->ajax()){
                $pickups = Pickup::all();
                return DataTables::of($pickups)
                    ->addIndexColumn()
                    ->addColumn('action',function ($pickup){
                        $actionBtn = '<a href="#" class="btn btn-sm btn-info edit" data-id="'.($pickup->id).'" data-toggle="modal" data-target="#editpickup"> <span class="fa fa-edit"></span></a>
                            <a href="'.route('pickupDelete',[$pickup->id]).'" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.pickup.pickup');
        }


        public function Insert(Request $request){
            $data = array(
                'pickup_point_name'     => $request->pickup_point_name,
                'pickup_point_address'  =>$request->pickup_point_address,
                'pickup_point_phone'    =>$request->pickup_point_phone
            );
            Pickup::insert($data);
            $notificaiton = array('messege'=>'Pickup Point Info Successfylly Inserted','alert-type'=>'success');
            return redirect()->back()->with($notificaiton);
        }


        public function Edit($id){
            $pickup = Pickup::find($id);
            return view('admin.pickup.Edit',[
                'pickup'=>$pickup
            ]);
        }

        public function Update(Request $request){
            $data = array(
                'pickup_point_name'     => $request->pickup_point_name,
                'pickup_point_address'  =>$request->pickup_point_address,
                'pickup_point_phone'    =>$request->pickup_point_phone
            );
            DB::table('pickups')->where('id',$request->id)->update($data);
            $notificaiton = array('messege'=>'Pickup Point Info Successfylly Updated','alert-type'=>'info');
            return redirect()->back()->with($notificaiton);
        }


        public function Delete($id){
            $pickup = Pickup::find($id);
            $pickup->delete();
            $notificaiton = array('messege'=>'Pickup Point Info Successfylly Deleted','alert-type'=>'error');
            return redirect()->back()->with($notificaiton);
        }
}
