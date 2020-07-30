<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['namespace'=>'Client','prefix'=>'/'],function (){
	Route::get('/home', 'HomeController@index');
	Route::get('/about-us', 'HomeController@about');
	
	Route::get('/register', 'HomeController@register');
	Route::get('/product-all','ProductController@index');
    Route::get('/product-detail','ProductController@product_detail');
	Route::get('/cart-page','CartController@cartpage');
    Route::get('/checkout','CartController@checkout');
    Route::get('/payment','CartController@payment');
    Route::get('/return-payment','CartController@returnpayment');
    Route::get('add-to-cart', 'CartController@addToCart');
    Route::delete('remove-from-cart', 'CartController@removeFromCart');
    Route::patch('update-cart', 'CartController@updateCart');
    // send gmail
    Route::get('/contact-us', 'HomeController@contact');
    Route::post('/contact-us', 'HomeController@sendContact')->name('sendcontact');
});
Route::group(['middleware' => ['web']], function () {
	Route::get('lang/{lang}','LanguageController@changelang')->name('lang');
    Route::get('login', 'Auth\LoginController@webLogin');
    Route::post('login', ['as'=>'client.login','uses'=>'Auth\LoginController@webLoginPost']);
    Route::get('logout', 'Auth\LoginController@webLogout');
    Route::post('logout', ['as'=>'client.logout','uses'=>'Auth\LoginController@webLogout']);
    Route::post('register',['as' => 'client.register', 'uses' => 'Client\RegisterController@create']);
    
    Route::get('admin/login', 'Admin\LoginController@showAdminLogin');
    Route::post('admin/login', ['as'=>'admin.login','uses'=>'Admin\LoginController@adminLogin']);
    Route::get('admin/logout', 'Admin\LoginController@adminLogout');
    Route::post('admin/logout', ['as'=>'admin.logout','uses'=>'Admin\LoginController@adminLogout']);
	
    Route::middleware(['checkuser'])->group(function () {
		Route::group(['namespace'=>'Admin','prefix'=>'/'],function (){
	    	Route::get('/admin/dashboard', 'DashboardController@index');
			Route::prefix('admin/user')->group(function () {
				Route::get('', [
					'as' => 'user.index',
					'uses' => 'UserController@index',
					'middleware' => 'checkacl:view_user'
				]);
				Route::get('/create', [
					'as' => 'user.create',
					'uses' => 'UserController@create',
					'middleware' => 'checkacl:create_user'
				]);
				Route::post('/create', 'UserController@store')->name('user.store');
				Route::get('/edit/{id}', [
					'as' => 'user.edit',
					'uses' => 'UserController@edit',
					'middleware' => 'checkacl:edit_user'
				]);
				Route::put('/edit/{id}', 'UserController@update')->name('user.update');
				Route::delete('/delete', [
					'as' => 'user.delete',
					'uses' =>'UserController@destroy',
					'middleware'=> 'checkacl:delete_user'
				]);
			});
			Route::prefix('admin/role')->group(function () {
				Route::get('', [
					'as' => 'role.index',
					'uses' => 'RoleController@index',
					'middleware' => 'checkacl:view_role'
				]);
				Route::get('/create', [
					'as' => 'role.create',
					'uses' => 'RoleController@create',
					'middleware' => 'checkacl:create_role'
				]);
				Route::post('/create', 'RoleController@store')->name('role.store');
				Route::get('/edit/{id}', [
					'as' => 'role.edit',
					'uses' => 'RoleController@edit',
					'middleware' => 'checkacl:edit_role'
				]);
				Route::put('/edit/{id}', 'RoleController@update')->name('role.update');
				Route::delete('/delete', [
					'as' => 'role.delete',
					'uses' =>'RoleController@destroy',
					'middleware'=> 'checkacl:delete_role'
				]);
			});
			Route::prefix('admin/brand')->group(function () {
				Route::get('', [
					'as' => 'brand.index',
					'uses' => 'BrandController@index',
					'middleware' => 'checkacl:view_brand'
				]);
				Route::get('/create', [
					'as' => 'brand.create',
					'uses' => 'BrandController@create',
					'middleware' => 'checkacl:create_brand'
				]);
				Route::post('/create', 'BrandController@store')->name('brand.store');
				Route::get('/brand/{id}', [
					'as' => 'brand.edit',
					'uses' => 'BrandController@edit',
					'middleware' => 'checkacl:edit_brand'
				]);
				Route::put('/edit/{id}', 'BrandController@update')->name('brand.update');
				Route::delete('/delete', [
					'as' => 'brand.delete',
					'uses' =>'BrandController@destroy',
					'middleware'=> 'checkacl:delete_brand'
				]);
			});

			// start
			Route::prefix('admin/customer')->group(function () {
				
				Route::get('', [
					'as' => 'customer.index',
					'uses' => 'CustomerController@index',
					// 'middleware' => 'checkacl:view_customer'

					
				]);
				Route::get('/create', [
					'as' => 'customer.create',
					'uses' => 'CustomerController@create',
					// 'middleware' => 'checkacl:create_customer'

					
				]);
				Route::post('/create', 'CustomerController@store')->name('customer.store');
				Route::get('/customer/{id}', [
					'as' => 'customer.edit',
					'uses' => 'CustomerController@edit',
					// 'middleware' => 'checkacl:edit_customer'

					
				]);
				Route::put('/edit/{id}', 'CustomerController@update')->name('customer.update');
				Route::delete('/delete', [
					'as' => 'customer.delete',
					'uses' =>'CustomerController@destroy',
					// 'middleware' => 'checkacl:delete_customer'

					
				]);		
			});
			// end
			Route::prefix('admin/category')->group(function () {
				Route::get('', [
					'as' => 'category.index',
					'uses' => 'CategoryController@index',
					'middleware' => 'checkacl:view_category'
				]);
				Route::get('/create', [
					'as' => 'category.create',
					'uses' => 'CategoryController@create',
					'middleware' => 'checkacl:create_category'
				]);
				Route::post('/create', 'CategoryController@store')->name('category.store');
				Route::get('/category/{id}', [
					'as' => 'category.edit',
					'uses' => 'CategoryController@edit',
					'middleware' => 'checkacl:edit_category'
				]);
				Route::put('/edit/{id}', 'CategoryController@update')->name('category.update');
				Route::delete('/delete', [
					'as' => 'category.delete',
					'uses' =>'CategoryController@destroy',
					'middleware'=> 'checkacl:delete_category'
				]);
			});
			Route::prefix('admin/product')->group(function () {
				Route::get('', [
					'as' => 'product.index',
					'uses' => 'ProductController@index',
					'middleware' => 'checkacl:view_product'
				]);
				Route::get('/create', [
					'as' => 'product.create',
					'uses' => 'ProductController@create',
					'middleware' => 'checkacl:create_product'
				]);
				Route::post('/create', 'ProductController@store')->name('product.store');
				Route::get('/product/{id}', [
					'as' => 'product.edit',
					'uses' => 'ProductController@edit',
					'middleware' => 'checkacl:edit_product'
				]);
				Route::put('/edit/{id}', 'ProductController@update')->name('product.update');
				Route::delete('/delete', [
					'as' => 'product.delete',
					'uses' =>'ProductController@destroy',
					'middleware'=> 'checkacl:delete_product'
				]);
			});
			Route::prefix('admin/slide')->group(function () {
				Route::get('', [
					'as' => 'slide.index',
					'uses' => 'SlideController@index',
					'middleware' => 'checkacl:view_slide'
				]);
				Route::get('/create', [
					'as' => 'slide.create',
					'uses' => 'SlideController@create',
					'middleware' => 'checkacl:create_slide'
				]);
				Route::post('/create', 'SlideController@store')->name('slide.store');
				Route::get('/slide/{id}', [
					'as' => 'slide.edit',
					'uses' => 'SlideController@edit',
					'middleware' => 'checkacl:edit_slide'
				]);
				Route::put('/edit/{id}', 'SlideController@update')->name('slide.update');
				Route::delete('/delete', [
					'as' => 'slide.delete',
					'uses' =>'SlideController@destroy',
					'middleware'=> 'checkacl:delete_slide'
				]);
			});
			Route::prefix('admin/order')->group(function () {
				Route::get('', [
					'as' => 'order.index',
					'uses' => 'OrderController@index',
					'middleware' => 'checkacl:view_order'
				]);
				Route::get('/create', [
					'as' => 'order.create',
					'uses' => 'OrderController@create',
					'middleware' => 'checkacl:create_order'
				]);
				Route::post('/create', 'OrderController@store')->name('order.store');
                Route::get('/show/{id}', [
                    'as' => 'order.show',
                    'uses' => 'OrderController@show',
                    'middleware' => 'checkacl:detail_order'
                ]);
				Route::get('/edit?id={id}', [
					'as' => 'order.edit',
					'uses' => 'OrderController@edit',
					'middleware' => 'checkacl:edit_order'
				]);
				Route::put('/update/{id}', 'OrderController@update')->name('order.update');
				Route::delete('/delete', [
					'as' => 'order.delete',
					'uses' =>'OrderController@destroy',
					'middleware'=> 'checkacl:delete_order'
				]);
			});
		});
	});
});