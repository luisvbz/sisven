<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;

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

Route::middleware('splade')->group(function () {
    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::middleware('auth')->group(function () {
        Route::get('/',[TestController::class, 'index'])->middleware(['verified'])->name('dashboard');
        Route::group(['prefix' => 'usuarios'], function(){

            Route::get('/',[UsersController::class, 'index'])->name('us.index')->middleware('permission:us:access');
            Route::get('/agregar',[UsersController::class, 'add'])->name('us.add')->middleware('permission:us:create');
            Route::post('/agregar',[UsersController::class, 'store'])->name('us.store')->middleware('permission:us:create');
            Route::get('/{user}/editar',[UsersController::class, 'edit'])->name('us.edit')->middleware('permission:us:edit');
            Route::put('/{user}/editar',[UsersController::class, 'update'])->name('us.update')->middleware('permission:us:edit');
            Route::get('/{user}/detalles',[UsersController::class, 'getDetails'])->name('us.details')->middleware('permission:us:access');
            Route::post('/{user}/toggle',[UsersController::class, 'toggleStatus'])->name('us.toogle-status')->middleware('permission:us:activate');
            Route::delete('/{user}/delete',[UsersController::class, 'delete'])->name('us.delete')->middleware('permission:us:delete');
        });


        Route::group(['prefix' => 'tiendas'], function(){

            Route::get('/',[StoresController::class, 'index'])->name('ti.index')->middleware('permission:ti:access');
            Route::get('/agregar',[StoresController::class, 'add'])->name('ti.add')->middleware('permission:ti:create');
            Route::post('/agregar',[StoresController::class, 'store'])->name('ti.store')->middleware('permission:ti:create');
            Route::get('/{store}/edit',[StoresController::class, 'edit'])->name('ti.edit')->middleware('permission:ti:edit');
            Route::patch('/{store}/edit',[StoresController::class, 'update'])->name('ti.update')->middleware('permission:ti:edit');
            Route::delete('/{store}/delete',[StoresController::class, 'delete'])->name('ti.delete')->middleware('permission:ti:delete');
        });

        Route::group(['prefix' => 'productos'], function(){

            Route::get('/',[ProductsController::class, 'index'])->name('pr.index')->middleware('permission:pr:access');
            Route::get('/agregar',[ProductsController::class, 'add'])->name('pr.add')->middleware('permission:pr:create');
            Route::post('/agregar',[ProductsController::class, 'store'])->name('pr.store')->middleware('permission:pr:create');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});

Route::middleware('auth')->group(function () {
    Route::get('/commons/provinces/{departamentId}', [CommonController::class, 'getProvices'])->name('get-province');
    Route::get('/commons/districts/{provinceId}', [CommonController::class, 'getDistricts'])->name('get-districts');
    Route::get('/commons/get-type-category/{typeId}', [CommonController::class, 'getCategory'])->name('get-category');
});
