<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KategoriController as ControllersKategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UmkmController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');;
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/', [ProductController::class, 'index']);
Route::get('/get-products', [ProductController::class, 'getProducts']);
Route::get('/get-product/{id}', [ProductController::class, 'productById']);



Route::get('/all-kategori', [ControllersKategoriController::class, 'allKategori']);
Route::get('/get-product-category/{id}', [ControllersKategoriController::class, 'getProductsByCategory']);
Route::get('/kategori/{id}', [ControllersKategoriController::class, 'kategori']);

//UMKM
Route::get('/all-umkm', [UmkmController::class, 'allUmkm']);
Route::get('/get-umkm', [UmkmController::class, 'getUmkm']);
Route::get('/umkm-profil/{id}', [UmkmController::class, 'umkmById']);
Route::get('/umkm-produk-data/{id}', [UmkmController::class, 'getProductsByUmkm']);

Route::get('/checkout/{id}', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/checkout_success', [CheckoutController::class, 'checkoutSuccess'])->name('checkout_success');



Route::middleware(['auth', 'role:admin,pt'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [Dashboard::class, 'index']);
    
        //UMKM
        Route::get('/umkm', [AdminUmkmController::class, 'index']);
        Route::get('/umkm-data', [AdminUmkmController::class, 'getUmkm']);
        Route::post('/umkm-insert', [AdminUmkmController::class, 'insertUmkm']);
        Route::post('/umkm-update', [AdminUmkmController::class, 'updateUmkm']);
        Route::delete('/umkm-delete/{id}', [AdminUmkmController::class, 'destroy']);
        Route::get('/umkm-by-id/{id}', [AdminUmkmController::class, 'getUmkmbyId']);
    
        //Kategori
        Route::get('/kategori', [KategoriController::class, 'index']);
        Route::get('/kategori-data', [KategoriController::class, 'getDatatablesKategori']);
        Route::post('/kategori-insert', [KategoriController::class, 'insertKategori']);
        Route::post('/kategori-update', [KategoriController::class, 'updateKategori']);
        Route::delete('/kategori-delete/{id}', [KategoriController::class, 'destroy']);
        
    
         //produk
         Route::get('/produk', [ProdukController::class, 'index']);
         Route::get('/produk-data', [ProdukController::class, 'getDatatables']);
         Route::post('/produk-insert-data', [ProdukController::class, 'insert']);
         Route::post('/produk-update-data', [ProdukController::class, 'update']);
         Route::delete('/produk-delete/{id}', [ProdukController::class, 'destroy']);
         Route::get('/produk-galeri/{id}', [ProdukController::class, 'galeri']);
         Route::delete('/produk-delete-galeri/{id}', [ProdukController::class, 'destroyGaleri']);
         Route::post('/produk-insert', [ProdukController::class, 'insertGaleri']);
         Route::get('/produk-by-id/{id}', [ProdukController::class, 'getData']);

         Route::get('/config', [SettingController::class, 'app']);
         Route::post('/setting-update', [SettingController::class, 'updateConfig']);
         Route::post('/setting-update-logo', [SettingController::class, 'updateLogo']);

         Route::get('/checkout-list', [TransaksiController::class, 'checkout']);
         Route::get('/checkout-data', [TransaksiController::class, 'getDatatables']);
    });
});


