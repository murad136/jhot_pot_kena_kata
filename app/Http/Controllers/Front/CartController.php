<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
        public function addCart(Request $request){
            $product = Product::find($request->id);
            Cart::add([
                            'id'         => $request->id,
                            'name'   => $request->name,
                            'qty'       => $request->product_qty,
                            'price'    => $request->price,
                            'weight' => 0,
                                    'options' => [
                                                        'size' => $request->size,
                                                        'color' => $request->color,
                                                        'thumbnail' =>$request->thumbnail
                                                        ]
                     ]);
            return redirect()->route('showCartTable');
//            $notification = array('messege'=>'Your Products Successfully Add To Cart','alert-type'=>'success');
//            return redirect()->back()->with($notification);
        }



        public function showCartProducts(){
            $categories = Categorie::all();
            $brands       =  Brand::all();
            $products = Cart::content();
            return view('frontEnd.showCart.cartProducts',[
                'categories' =>$categories,
                'brands'       =>$brands,
                'products'   =>$products
            ]);
        }

//        public function updateQty(Request $request){
//            Cart::update($request->rowId, $request->qtyUpdate);
//            return redirect('/showCartTable');
//        }

            public function cartProductDelete($rowId){
                Cart::remove($rowId);
                return redirect('/showCartTable');
            }

}
