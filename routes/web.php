<?php

use Illuminate\Support\Facades\Redirect;

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'], function(){
   Route::get('/',function() {
        return view('home');
   });

    Route::resource('produk', ProdukController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('vendor', VendorController::class);
    Route::resource('barangMasuk', BarangMasukController::class);
    Route::resource('barangKeluar', BarangKeluarController::class);
});

// Set default route
Route::get('/', function () {
    return Redirect::to('home');
});
