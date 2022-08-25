<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoreisController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\MainSite\SiteManagementController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Route::prefix(LaravelLocalization::setLocale())->group(function(){
// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {
Route::prefix('admin')->name('admin.')->middleware(['auth','verified','check_user'])->group(function() {
    Route::get('/', [AdminController::class , 'index'])-> name('index');

    Route::resource('categories',CategoreisController::class);
    Route::resource('products',ProductsController::class);
});

Route::get('/', function(){
    return view('welcome');
})->name('web.index');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('not-allowed','not-allowed')->name('not-allowed');
});


// Main Site
Route::prefix('E-commerce')->group(function(){

    Route::get('/',[SiteManagementController::class,'HomePage'])->name('E-commerce.home');

    Route::get('/shop',[SiteManagementController::class,'ShopPage'])->name('E-commerce.shop');
    Route::get('/shop/category/{category}',[SiteManagementController::class,'ShopCategory'])->name('E-commerce.ShopCategory');
    Route::get('/shop/SubCategory/{SubCategory}',[SiteManagementController::class,'ShopSubCategory'])->name('E-commerce.ShopSubCategory');
    Route::get('/shop/product/{product}',[SiteManagementController::class,'ProductPage'])->name('E-commerce.product');
   
    Route::get('/cart',[SiteManagementController::class,'ShowCart'])->name('E-commerce.Cart');
    Route::post('/cart',[SiteManagementController::class,'AddCart']);
   

    Route::view('/about','MainSite.about')->name('E-commerce.about');

    Route::view('/contact','MainSite.contact')->name('E-commerce.contact');
    Route::post('/contact',[SiteManagementController::class,'Message']);


});



Route::view('/test','MainSite.home');