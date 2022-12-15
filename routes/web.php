<?php

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SupplierController;
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

   Route::resource('barang', BarangController::class);
});


//Route::resource('barang', BarangController::class);

// Pelanggan
Route::get('pelanggan', [PelangganController::class, 'index']);
Route::get('pelanggan/detail/{code}', [PelangganController::class, 'detail']);
Route::get('pelanggan/add', function () {
    return view('pelanggan.add');
});
Route::post('pelanggan/post', [PelangganController::class, 'add']);

// Supplier
Route::get('supplier', [SupplierController::class, 'index']);
Route::get('supplier/detail/{code}', [SupplierController::class, 'detail']);
Route::get('supplier/add', function () {
    return view('supplier.add');
});
Route::post('supplier/post', [SupplierController::class, 'add']);

// Set default route
Route::get('/', function () {
    return Redirect::to('home');
});
