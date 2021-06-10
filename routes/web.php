<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ExtracategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'userpage']);

Route::get('/login', function () {
	if(session()->has('adminLogindata'))
	{
		return redirect('/dashboard');
	}
    return view('admin.login');
});

Route::get('/gotoLoginPage', function(){
	return redirect('/login');
});

Route::post('/checkAdminLogin',[AdminController::class, 'checkAdminLogin']);

Route::post('/otp_checker',[AdminController::class, 'otpChecker']);

Route::get('/OtpCheckerPage', function(){
	return view('admin.otp_checker');
});

Route::get('/new_recover_password', function(){
	return view('admin.new_recover_password');
});

Route::post('/confirmChangepassword', [AdminController::class, 'changeNewPassword']);

Route::post('/checkAdminOTPdata', [AdminController:: class, 'checkAdminOTPdata']);

Route::middleware([AdminCheckLogin::class])->group(function(){
 
	Route::get('/view_admin',[AdminController::class, 'viewAdminRecords']);

	Route::post('/add_admin_records',[AdminController::class, 'addAdminRecords']);

	Route::get('/AdminDelete/{id}',[AdminController::class, 'DeleteAdminRecord']);

	Route::get('/AdminEdit/{id}',[AdminController::class, 'editAdminRecord']);

	Route::post('/edit_admin_records',[AdminController::class, 'UpdateAdminRecord']);

	Route::get('/dashboard', function () {
	    return view('admin.dashboard');
	});
	
	Route::get('/add_admin', function () {
		return view('admin.Add_admin');
	});

	Route::get('logoutadmin', function(){
		session()->forget('adminLogindata');
		return redirect('/');
	});

	Route::any('/searchingAdmin', [AdminController::class, 'SearchingRecord']);

	Route::post('/deleteMultiple',[AdminController::class, 'MultiDeleteRecord']);

	// Category Routes //

	Route::get('/add_category', function(){
		return view('admin.add_category');
	});

	Route::post('/add_category_records', [CategoryController::class, 'add_category']);

	Route::get('/view_category', [CategoryController::class, 'view_category_records']);

	Route::get('/CategoryDelete/{id}', [CategoryController::class, 'Delete_Category']);

	Route::get('/CategoryEdit/{id}', [CategoryController::class, 'Edit_record']);

	Route::post('/update_category_records', [CategoryController::class, 'update_category']);

	Route::any('/searchingCategory', [CategoryController::class, 'SearchingCategory']);

	Route::get('/Active_category/{id}', [CategoryController::class, 'active_category']);

	Route::get('/Deactive_category/{id}', [CategoryController::class, 'deactive_category']);

	Route::post('/deleteMultiple',[CategoryController::class, 'MultiDeleteRecord']);

	// SubCategory Routes //

	Route::get('/add_subcategory', [SubCategoryController::class, 'add_subcategory_page']);

	Route::post('/add_subcategory_records', [SubCategoryController::class, 'add_subcategory']);

	Route::get('/view_subcategory', [SubCategoryController::class, 'view_subcategory_record']);

	Route::get('/SubcategoryDelete/{id}', [SubCategoryController::class, 'delete_subcategory']);

	Route::get('/SubcategoryEdit/{id}', [SubCategoryController::class, 'edit_subcategory']);

	Route::post('/edit_subcategory_records', [SubCategoryController::class, 'update_subcategory_record']);

	Route::any('/searchingSubcategory', [SubCategoryController::class, 'SearchingSubcategory']);

	Route::get('/Active_subcategory/{id}', [SubCategoryController::class, 'active_subcategory']);

	Route::get('/Deactive_subcategory/{id}', [SubCategoryController::class, 'deactive_subcategory']);

	Route::post('/deleteMultiple',[SubCategoryController::class, 'MultiDeleteRecord']);

	// ExtraCategory Routes //

	Route::get('/add_extracategory', [ExtracategoryController::class, 'add_extracategory_page']);

	Route::post('/get_subcategory_record', [ExtracategoryController::class, 'get_subcategory_record']);

	Route::post('/add_extracategory_records', [ExtracategoryController::class, 'add_extracategory_record']);

	Route::get('/view_extracategory', [ExtracategoryController::class, 'view_extracategory_record']);

	Route::get('/ExtracategoryDelete/{id}', [ExtracategoryController::class, 'delete_extracategory_record']);

	Route::get('/ExtracategoryEdit/{id}', [ExtracategoryController::class, 'update_extracategory_record']);

	Route::post('/update_extracategory_records', [ExtracategoryController::class, 'update_extracategory_records']);

	Route::get('/Active_extracategory/{id}', [ExtracategoryController::class, 'active_extracategory']);

	Route::get('/Deactive_extracategory/{id}', [ExtracategoryController::class, 'deactive_extracategory']);

	Route::any('/searchingExtracategory', [ExtracategoryController::class, 'SearchingExtracategory']);

	Route::post('/deleteMultiple',[ExtracategoryController::class, 'MultiDeleteRecord']);

	// Type Routes //

	Route::get('/add_type', [TypeController::class, 'add_type_record']);

	Route::post('/get_extracategory_record_type', [TypeController::class, 'get_extracategory_record']);

	Route::post('/add_type_records', [TypeController::class, 'add_type_records']);

	Route::get('/view_type', [TypeController::class, 'view_type_records']);

	Route::get('/Active_type/{id}', [TypeController::class, 'active_type_record']);

	Route::get('/Deactive_type/{id}', [TypeController::class, 'deactive_type_record']);

	Route::get('/TypeDelete/{id}', [TypeController::class, 'delete_type_record']);

	Route::get('/TypeEdit/{id}', [TypeController::class, 'update_type_record']);

	Route::post('/update_type_records', [TypeController::class, 'update_type_Records']);

	Route::post('/deleteMultiple',[TypeController::class, 'MultiDeleteRecord']);

	Route::any('/searchingtype', [TypeController::class, 'SearchingType']);

	// Brand Routes //

	Route::get('/add_brand', [BrandController::class, 'add_brand_record']);

	Route::post('/add_brand_records', [BrandController::class, 'add_brand_Records']);

	Route::get('/view_brand', [BrandController::class, 'view_brand_records']);

	Route::get('/Active_brand/{id}', [BrandController::class, 'active_Brand']);

	Route::get('/Deactive_brand/{id}', [BrandController::class, 'deactibe_brand']);

	Route::get('/BrandDelete/{id}', [BrandController::class, 'delete_brand_record']);

	Route::get('/BrandEdit/{id}', [BrandController::class, 'update_type_record']);

	Route::post('/edit_brand_records', [BrandController::class, 'edit_brand_Records']);

	Route::any('/searchingbrand', [BrandController::class, 'SearchingBrand']);

	Route::post('/deleteMultiple',[BrandController::class, 'MultiDeleteRecord']);

	// Product Routes //

	Route::get('/add_product', [ProductController::class, 'add_product_page']);

	Route::post('/get_type_brand_record', [ProductController::class, 'get_type_brand_records']);

	Route::post('/get_brand_type_record', [ProductController::class, 'get_brand_type_records']);

	Route::post('/add_product_records', [ProductController::class, 'add_product_Records']); 

	Route::get('/view_product', [ProductController::class, 'view_product_records']);

});  