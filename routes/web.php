<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/', 'App\Http\Controllers\HomeController@index');
//Route::get('/categories', 'App\Http\Controllers\CategoryController@index');
//Route::get('/categories/details', 'App\Http\Controllers\CategoryController@details');
//Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
//Route::get('/detail/{id}', 'App\Http\Controllers\DetailController@index');
//Route::get('/cart', 'App\Http\Controllers\CartController@index');
//Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
//Route::get('/dashboard-account', 'App\Http\Controllers\DashboardSettingController@account');
//Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-account');
//Route::get('/dashboard-transactions', 'App\Http\Controllers\DashboardTransactionController@index');
//Route::get('/dashboard-transactions/{id}', 'App\Http\Controllers\DashboardTransactionController@details');
//Route::get('/dashboard-settings', 'App\Http\Controllers\DashboardSettingController@store');
//Route::get('/dashboard-products', 'App\Http\Controllers\DashboardProductController@index');
//Route::get('/dashboard-products/create', 'App\Http\Controllers\DashboardProductController@create')->name('dashboard-product-store');
// Route::get('/dashboard-products/create', 'DashboardProductController@create')->name('dashboard-products-create');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');
Route::get('/detail/{id}', 'DetailController@index')->name('detail');
Route::post('/detail/{id}', 'DetailController@add')->name('detail-add');
Route::get('/register/success', 'App\Http\Controllers\Auth\RegisterController@success');
Route::get('/success', 'App\Http\Controllers\CartController@success');
//persiapan callback
Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

//yang bisa mengakses grup middleware adalah user yg telah LOGIN
Route::group(['middleware' => ['auth']], function()
{
        Route::get('/cart', 'CartController@index')
                ->name('cart');
        Route::delete('/cart/{id}', 'CartController@delete')
                ->name('cart-delete');
        Route::post('/checkout', 'CheckoutController@process')
                ->name('checkout');
        Route::get('/dashboard', 'DashboardController@index')
                ->name('dashboard');

        Route::get('/dashboard/products', 'DashboardProductController@index')
                ->name('dashboard-products');
        Route::get('/dashboard/products/create', 'DashboardProductController@create')
                ->name('dashboard-products-create');
        Route::post('/dashboard/products', 'DashboardProductController@store')
                ->name('dashboard-product-store');

        Route::get('/dashboard-products/{id}', 'DashboardProductController@details')
                ->name('dashboard-products-details');
        Route::post('/dashboard-products/{id}', 'DashboardProductController@update')
                ->name('dashboard-products-update');
        Route::post('/dashboard-products/gallery/upload', 'DashboardProductController@uploadGallery')
                ->name('dashboard-products-gallery-upload');
        Route::get('/dashboard-products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')
                ->name('dashboard-products-gallery-delete');

        Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')
                ->name('dashboard-settings-redirect'); 
        Route::get('/dashboard/settings', 'DashboardSettingController@store')
                ->name('dashboard-settings-store');
        Route::get('/dashboard/account', 'DashboardSettingController@account')
                ->name('dashboard-settings-account');
                
        Route::get('/dashboard/transactions', 'DashboardTransactionController@index')
                ->name('dashboard-transactions');
        Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')
                ->name('dashboard-transactions-details');
        Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')
                ->name('dashboard-transaction-update');
        


         












        



       
               


                
                
});

//yang bisa mengakses prefix dashboard auth adalah user dengan roles ADMIN
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function() {
            Route::get('/', 'DashboardController@index')->name('admin-dashboard');
            Route::resource('category', 'CategoryController');
            Route::resource('user', 'UserController');
            Route::resource('product', 'ProductController');
            Route::resource('product-gallery', 'ProductGalleryController');
});

Auth::routes();



