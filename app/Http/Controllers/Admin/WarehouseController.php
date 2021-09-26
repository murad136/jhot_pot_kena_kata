<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function warehouseForm(Request $request){
        if ($request->ajax()){
              $warehouses = Warehouse::all();
                return DataTables::of($warehouses)

                ->addIndexColumn()
                ->addColumn('action',function($warehouse){
                    $actionBtn = '<a href="#" class="btn btn-sm btn-info edit" data-id=" '.($warehouse->id ).' " data-toggle="modal" data-target="#editWare"> <span class="fa fa-edit"></span></a>
                                            <a href="'.route('warehouseDelete',[$warehouse->id]).'" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true) ;
        }
        return view('admin.setting.warehouse.warehouseForm');
    }


    public function wareInsert(Request $request){
        $validated = $request->validate([
            'warehouse_name' => 'required|unique:warehouses|max:55',
        ]);
        $data = array();
        $data['warehouse_name']    = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone']   = $request->warehouse_phone;
        $data['warehouse_slug']       = Str::slug($request->warehouse_name,'.');
        Warehouse::insert($data);
        $notification = array('messege'=>'Warehouse Successfully Inserted','alert-type'=>'success');
        return redirect()->back()->with($notification);

    }



    public function Edit($id){
        $warehouse = Warehouse::find($id);
        return view('admin.setting.warehouse.Edit',[
            'warehouse'=>$warehouse
        ]);
    }


    public function Update(Request $request){
        $data = array();
        $data['warehouse_name']    = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone']   = $request->warehouse_phone;
        $data['warehouse_slug']       = Str::slug($request->warehouse_name,'.');
        DB::table('warehouses')->where('id',$request->id)->update($data);
        $notification = array('messege'=>'Warehouse Successfully Updated!','alert-type'=>'info');
        return redirect()->back()->with($notification);

    }

    public function Delete($id){
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        $notification = array('messege'=>'Warehouse Successfully Deleted!','alert-type'=>'error');
        return redirect()->back()->with($notification);
    }

}
