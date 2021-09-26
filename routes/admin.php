<?php
use Illuminate\Support\Facades\Route;


Route::get('/admin_login', [App\Http\Controllers\Auth\LoginController::class,'Admin_login'])->name('admin_login');

Route::group(['namespace'=> 'App\Http\Controllers\Admin','middleware'=>'is_admin'],function (){

    Route::get('/admin_home','AdminController@AdminHomePage')->name('admin_home');
    Route::get('/admin_logout','AdminController@AdminLogOut')->name('AdmIn_logouT');
    Route::get('/password_reset','AdminController@PasswordReset')->name('password_reset');
    Route::post('/password_update','AdminController@PasswordUpadate')->name('password_update');

                Route::group(['prefix' => 'categorie'],function (){
                            Route::get('/','CategorieController@CategorieTable')->name('categorie_table');
                            Route::post('/categorie_insert','CategorieController@CategorieInsert')->name('categorieInsert');
                            Route::get('/edit/{id}','CategorieController@CategorieEdit');
                            Route::post('/categorie_update','CategorieController@CategorieUpdate')->name('categorie_update');
                            Route::get('/categorie_delete/{id}','CategorieController@CategorieDelete')->name('categorie_delete');
                        });

                //global route here
                            Route::get('/get-child-categorie/{id}','CategorieController@GetChildCategorie');
                //global route

                Route::group(['prefix' => 'subcategorie'],function (){
                            Route::get('/','SubcategorieController@SubcategorieTable')->name('subcategorie_table');
                            Route::post('/subcat_insert','SubcategorieController@SubcategorieInsert')->name('subcategorie_insert');
                            Route::get('/edit/{id}','SubcategorieController@SubcategorieEdit');
                            Route::post('/subcategorie_update','SubcategorieController@SubcategorieUpdate')->name('subcategorie_update');
                            Route::get('/subcategorie_detele/{id}','SubcategorieController@SubcategorieDelete')->name('subcategorie_delete');
                        });

                Route::group(['prefix' => 'childcategorie'],function (){
                            Route::get('/','ChildcategorieController@childcategorieTable')->name('childcategorie_table');
                            Route::post('/childcategorie_insert','ChildcategorieController@childcategorieInsert')->name('childcategorie_insert');
                            Route::get('/edit/{id}','ChildcategorieController@childcategorieEdit');
                            Route::post('/childcategorie_update','ChildcategorieController@childcategorieUpdate')->name('childcategorie_update');
                            Route::get('/childcategorie_delete/{id}','ChildcategorieController@childcategorieDelete')->name('childcategorie_delete');
                        });
                Route::group(['prefix'=>'brand'],function (){
                            Route::get('/','BrandController@brandTable')->name('brand_table');
                            Route::post('/brand_insert','BrandController@brandInsert')->name('brand_insert');
                            Route::get('/edit/{id}','BrandController@brandEdit');
                            Route::post('/brand_update','BrandController@brandUpdate')->name('brand_update');
                            Route::get('/brand_delete/{id}','BrandController@brandDelete')->name('brand_delete');
                        });
                Route::group(['prefix'=>'coupn'],function (){
                            Route::get('/','CounpController@coupnForm')->name('coupnForm');
                            Route::post('/coupn_insert','CounpController@coupnInsert')->name('coupnInsert');
                            Route::get('/edit/{id}','CounpController@Edit');
                            Route::post('/updateCoupn','CounpController@coupnUpdate')->name('coupnUpdate');
                            Route::get('/coupnDelete/{id}','CounpController@coupnDelete')->name('coupnDelete');
                });
                Route::group(['prefix'=>'campaign'],function (){
                            Route::get('/','CampaignController@campaignTable')->name('campaignTable');
                            Route::post('/campaignAdd','CampaignController@AddCampaign')->name('campaignAdd');
                            Route::get('/edit/{id}','CampaignController@EditCampaign');
                            Route::post('/campaignUpdate','CampaignController@UpdateCampaign')->name('campaignUpdate');
                            Route::get('/campaignDelete/{id}','CampaignController@DeleteCampaign')->name('campaignDelete');
                });
                Route::group(['prefix'=>'setting'],function (){
                            Route::group(['prefix'=>'seo'],function (){
                                Route::get('/','SeoController@seoForm')->name('seo_setup');
                                Route::post('/seo_update/{id}','SeoController@seoUpdate')->name('seo_update');
                            });
                            Route::group(['prefix'=>'smtp'],function (){
                                Route::get('/','SmtpController@smtpForm')->name('smtp_form');
                                Route::post('/smtp_update/{id}','SmtpController@smtpUpdate')->name('smtp_update');
                            });
                            Route::group(['prefix'=>'page_management'],function (){
                                Route::get('/','PageController@pageManageTable')->name('pageManageTable');
                                Route::get('/pageCreteForm','PageController@pageCreateForm')->name('pageCreateForm');
                                Route::post('/newPageCreate','PageController@newPageCreate')->name('newPageCreate');
                                Route::get('/pageEdit/{id}','PageController@pageEdit')->name('pageEdit');
                                Route::post('/pageUpdate/{id}','PageController@pageUpdate')->name('pageUpdate');
                                Route::get('/pageDelete/{id}','PageController@pageDelete')->name('pageDelete');
                            });
                            Route::group(['prefix'=>'web_setting'],function (){
                                Route::get('/','WebController@webSetting')->name('webSetting');
                                Route::post('/Update/{id}','WebController@SettingUpdate')->name('webSettingUpdate');
                            });
                            Route::group(['prefix'=>'warehouse'],function (){
                                Route::get('/','WarehouseController@warehouseForm')->name('warehouseForm');
                                Route::post('/warehouseInsert','WarehouseController@wareInsert')->name('warehouseInsert');
                                Route::get('/edit/{id}','WarehouseController@Edit');
                                Route::post('/warehouse_update','WarehouseController@Update')->name('wareHouseUpdate');
                                Route::get('/warehouseDelete/{id}','WarehouseController@Delete')->name('warehouseDelete');
                            });
                });
                Route::group(['prefix'=>'pickup'],function (){
                    Route::get('/','PickupController@pickupForm')->name('pickupForm');
                    Route::post('/pickupInsert','PickupController@Insert')->name('pickupInsert');
                    Route::get('/edit/{id}','PickupController@Edit');
                    Route::post('/pickupUpdate','PickupController@Update')->name('pickupUpdate');
                    Route::get('/pickupDelete/{id}','PickupController@Delete')->name('pickupDelete');
                });
                Route::group(['prefix'=>'product'],function (){
                    Route::get('/','ProductController@productTable')->name('productTable');
                    Route::post('/prodectInsert','ProductController@productInsert')->name('prodectInsert');
                    Route::get('/manageProduct','ProductController@mangeProduct')->name('manageProduct');
                    Route::get('/productEdit/{id}','ProductController@productEdit')->name('productEdit');
                    Route::post('/product_update','ProductController@updateProduct')->name('product_update');
                    Route::get('/productDelate/{id}','ProductController@productDelate')->name('productDelate');
                    //active deactive switch
                    Route::get('/deactive_feat/{id}','ProductController@deactiveFeat');
                    Route::get('/active_feat/{id}','ProductController@activeFeat');
                    Route::get('/deactive_deal/{id}','ProductController@deactiveDeal');
                    Route::get('/active_deal/{id}','ProductController@activeDeal');
                    Route::get('/deactive_status/{id}','ProductController@deactiveStatus');
                    Route::get('/active_status/{id}','ProductController@activeStatus');
                });

});
