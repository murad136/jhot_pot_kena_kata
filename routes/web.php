<?php
use Illuminate\Support\Facades\Route;

Auth::routes();

//Route::get('/login',function (){
//    return redirect()->to('/');
//})->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'customerLogout'])->name('customerLoGout');

Route::group(['namespace'=>'App\Http\Controllers\Front'],function (){
            Route::get('/','FrontEndController@index');
            Route::get('/bannerProductDetails/{id}','FrontEndController@bannerProDetails')->name('bannerProductDetails');
//            Route::get('/addWishlist/{id}','FrontEndController@wishlistAdd')->name('addWishlist');
            Route::get('/homeProductDetails/{id}','FrontEndController@homeProductDetails')->name('homeProductDetails');
            Route::get('/todayDealDetails/{id}','FrontEndController@todayDealDetails')->name('todayDealDetails');
            Route::get('/featuredProductDetails/{id}','FrontEndController@featuredDetails')->name('featuredProductDetails');
            Route::post('/addToCart','CartController@addCart')->name('addToCart');
            Route::get('/showCartTable',[
                            'uses' => 'CartController@showCartProducts',
                            'as'    => 'showCartTable'
            ]);
//            Route::post('/qtyUpdate/{rowId}',[
//                                'uses' => 'CartController@updateQty',
//                                'as'     => 'qtyUpdate'
//            ]);

            Route::get('/cartProductDelete/{rowId}',[
                            'uses' => 'CartController@cartProductDelete',
                            'as'     => 'cartProductDelete'
            ]);


});
