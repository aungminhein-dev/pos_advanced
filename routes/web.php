<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\SubCategoryController;

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
Route::controller(GuestController::class)->middleware('is_admin')->group(function(){
    Route::get('/','home')->name("home");
    Route::get('about','about')->name("about");
    Route::get('contact','contact')->name("contact");
    Route::get('shop','shop')->name("shop");
    Route::get('blog','blog')->name("blog");
    Route::get('privacy-policy','privacy')->name('privacy');
    Route::get('loginPage','loginPage')->name("loginPage");
    Route::get('registerPage','registerPage')->name("registerPage");

});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // admin
    Route::prefix('admin')->middleware('is_admin')->group(function(){
        Route::get('dashboard',[AuthController::class,'adminDashboard'])->name('admin.dashboard');

        // category route groups
        Route::controller(CategoryController::class)->prefix('categories')->group(function(){
            Route::get('list','list')->name('category.list');
            Route::get('add/page','addPage')->name('category.addPage');
            Route::post('add','add')->name('category.add');
            Route::get('{slug}/edit','edit')->name('category.edit');
            Route::get('{slug}/detail','detail')->name('category.detail');
            Route::post('update','update')->name('category.update');
            Route::post('delete','delete')->name('category.delete');
        });

        // sub categories
        Route::controller(SubCategoryController::class)->prefix('sub-categories')->group(function(){
            Route::post('add','add')->name('sub-category.add');
            Route::get('list','list')->name('sub-category.list');
            // Route::get('edit','edit')->name('sub-category.edit');
            // Route::put('update','update')->name('sub-category.update');
            Route::get('delete/{id}','delete')->name('sub-category.delete');
        });

         // products route groups
        Route::controller(ProductController::class)->prefix('products')->group(function(){
            Route::get('list','list')->name('product.list');
            Route::get('add/page','addPage')->name('product.addPage');
            Route::post('add','add')->name('product.add');
            Route::get('{slug}/edit','edit')->name('product.edit');
            Route::get('{slug}/detail','detail')->name('product.detail');
            Route::post('update','update')->name('product.update');
            Route::post('delete','delete')->name('product.delete');
            Route::post('delete/images','deleteImage')->name('product.image.delete');
        });

        Route::controller(BrandController::class)->prefix('brands')->group(function(){
            Route::get('add/page','addPage')->name('brand.addPage');
            Route::get('list','list')->name('brand.list');
            Route::post('add','add')->name('brand.add');
            Route::get('edit/{id}','edit')->name('brand.edit');
            Route::get('delete/{id}','delete')->name('brand.delete');
            Route::post('update','update')->name('brand.update');
        });

        Route::controller(DiscountController::class)->prefix('discounts')->group(function(){
            Route::post('add','add')->name('discount.add');
            Route::post('update','update')->name('discount.update');
            Route::post('add/bulk','bulkAdd')->name('disount.bulkAdd');

        });

        Route::controller(EventController::class)->prefix('events')->group(function(){
            Route::get('list','list')->name('event.list');
            Route::get('add/page','addPage')->name('event.addPage');
            Route::post('add','add')->name('event.add');
            Route::get('{slug}/add/discount/item','addItems')->name('event.add-items');
            // Route::post('')
        });

        Route::controller(TagController::class)->prefix('discount')->group(function(){
            Route::get('delete/{tag}','delete')->name('tag.delete');
        });
    });

    // user
    Route::prefix('user')->middleware('is_user')->group(function(){
        Route::controller(UserHomeController::class)->group(function(){

        });
    });
});
