<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{


    public function index(){
        $categories      =Categorie::all();
        $products        = Product::where('product_slider',1)
                                                ->orderBy('id','DESC')
                                                ->where('status',1)
                                                ->first();
        $brands             = Brand::all();
        $new_products = Product::where('status',1)
                                                      ->orderBy('id','DESC')
                                                      ->get();
        $featProducts   = Product::where('featured',1)
                                                    ->where('status',1)
                                                    ->orderBy('id','DESC')
                                                    ->take(5)
                                                    ->skip(3)
                                                    ->get();
        $today_deals   = Product::where('today_deal',1)
                                                    ->orderBy('id','ASC')
                                                    ->where('status',1)
                                                    ->get();
            return view('frontEnd.home',[
            'categories'          =>$categories,
            'products'            =>$products,
            'brands'               =>$brands,
            'featProducts'     =>$featProducts,
             'new_products'  =>$new_products,
             'today_deals'     =>$today_deals
        ]);
    }

        public function bannerProDetails($id){
            $categories =Categorie::all();
            $brands      = Brand::all();
            $products = Product::where('id',$id)
                                                ->where('status',1)
                                                ->first();
            return view('frontEnd.product.productDetails',[
            'categories'       =>$categories,
            'products'         =>$products,
             'brands'            =>$brands
        ]);
        }

//        public function wishlistAdd($id){
//            $wishlist = DB::table('wishlists')->where('product_id',$id)->where('user_id ',Auth::id())->first();
//            if ($wishlist){
//                $notification = array('messege'=>'You Allready Submited!','alert-type'=>'error');
//                return redirect()->back()->with($notification);
//            }else{
//                    $data = array();
//                    $data['product_id'] = $id;
//                    $data['user_id']        = Auth::id();
//                    DB::table('wishlists')->insert($data);
//                    $notification = array('messege'=>'Wishlist successfully Submit!','alert-type'=>'success');
//                    return redirect()->back()->with($notification);
//            }
//        }


        public function homeProductDetails($id){
            $categories = Categorie::all();
            $brands       = Brand::all();
            $products = Product::where('id',$id)
                                                 ->where('status',1)
                                                 ->first();
            return view('frontEnd.product.homeProductDetails',[
                'products'      =>$products,
                'categories'    =>$categories,
                'brands'          =>$brands

            ]);
        }


        public function todayDealDetails($id){
            $categories = Categorie::all();
            $brands       = Brand::all();
            $todayDealDetails = Product::where('id',$id)
                                                                 ->where('today_deal',1)
                                                                 ->where('status',1)
                                                                 ->first();
            return view('frontEnd.product.todayDealDetails',[
                'todayDealDetails' =>$todayDealDetails,
                'categories'    =>$categories,
                'brands'          =>$brands
            ]);
        }


        public function featuredDetails($id){
            $categories = Categorie::all();
            $brands       = Brand::all();
            $featuredProducts = Product::where('id',$id)
                                                                ->where('featured',1)
                                                                ->where('status',1)
                                                                ->first();
            return view('frontEnd.product.featuredProductDetails',[
                'featuredProducts' =>$featuredProducts,
                'categories'    =>$categories,
                'brands'          =>$brands
            ]);
        }

}
