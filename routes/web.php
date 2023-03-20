<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportesCotroller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SuplliersController;
use App\Http\Controllers\TransfersController;
use App\Http\Controllers\WarehouseController;

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
            Route::get('/{store}/movimientos',[StoresController::class, 'movements'])->name('ti.movements')->middleware('permission:ti:access');
            Route::get('/{store}/movimientos/{movement}/detalles',[StoresController::class, 'movementsDetails'])->name('ti.movements-details')->middleware('permission:ti:access');
            Route::get('/{store}/stock',[StoresController::class, 'stock'])->name('ti.stock')->middleware('permission:ti:access');
            //Transferencias
            Route::get('/solicitar-productos', [TransfersController::class, 'add'])
                    ->name('ti.request-product');
            Route::post('/solicitar-productos', [TransfersController::class, 'store'])
                    ->name('ti.request-product-store');
        });

        Route::group(['prefix' => 'almacenes'], function(){

            Route::get('/',[WarehouseController::class, 'index'])->name('wr.index')->middleware('permission:wr:access');
            Route::get('/agregar',[WarehouseController::class, 'create'])->name('wr.add')->middleware('permission:wr:create');
            Route::post('/agregar',[WarehouseController::class, 'store'])->name('wr.store')->middleware('permission:wr:create');
            Route::get('/trasladar-mercancia',[WarehouseController::class, 'formTrasfer'])->name('wr.trasnfer')->middleware('permission:wr:create');
            Route::post('/trasladar-mercancia',[WarehouseController::class, 'storeTransfer'])->name('wr.trasnfer-store')->middleware('permission:wr:create');
            Route::get('/{warehouse}/edit',[WarehouseController::class, 'edit'])->name('wr.edit')->middleware('permission:wr:edit');
            Route::patch('/{warehouse}/edit',[WarehouseController::class, 'update'])->name('wr.update')->middleware('permission:wr:edit');
            Route::get('/{warehouse}/movimientos',[WarehouseController::class, 'movements'])->name('wr.movements')->middleware('permission:wr:access');
            Route::get('/{warehouse}/movimientos/{movement}/detalles',[WarehouseController::class, 'movementsDetails'])->name('wr.movements-details')->middleware('permission:wr:access');
            Route::get('/{warehouse}/stock',[WarehouseController::class, 'stock'])->name('wr.stock')->middleware('permission:wr:access');
        });

        Route::group(['prefix' => 'proveedores'], function(){

            Route::get('/',[SuplliersController::class, 'index'])->name('pv.index')->middleware('permission:pv:access');
            Route::get('/agregar',[SuplliersController::class, 'create'])->name('pv.add')->middleware('permission:pv:create');
            Route::post('/agregar',[SuplliersController::class, 'store'])->name('pv.store')->middleware('permission:pv:create');
            Route::get('{supplier}/editar',[SuplliersController::class, 'edit'])->name('pv.edit')->middleware('permission:pv:edit');
            Route::patch('{supplier}/editar',[SuplliersController::class, 'update'])->name('pv.update')->middleware('permission:pv:edit');

        });


        Route::group(['prefix' => 'compras'], function(){

            Route::get('/',[OrdersController::class, 'index'])->name('co.index')->middleware('permission:co:access');
            Route::get('/agregar',[OrdersController::class, 'create'])->name('co.add')->middleware('permission:co:create');
            Route::post('/agregar',[OrdersController::class, 'store'])->name('co.store')->middleware('permission:co:create');
            Route::get('/{order}/detalles',[OrdersController::class, 'details'])->name('co.details')->middleware('permission:co:access');

        });

        Route::group(['prefix' => 'productos'], function(){

            Route::get('/',[ProductsController::class, 'index'])->name('pr.index')->middleware('permission:pr:access');
            Route::get('/agregar',[ProductsController::class, 'add'])->name('pr.add')->middleware('permission:pr:create');
            Route::post('/agregar',[ProductsController::class, 'store'])->name('pr.store')->middleware('permission:pr:create');
            Route::get('/{product}/stock-tiendas',[ProductsController::class, 'getStockTiendas'])->name('pr.stock-tiendas')->middleware('permission:pr:access');
            Route::get('/{product}/editar',[ProductsController::class, 'edit'])->name('pr.edit')->middleware('permission:pr:edit');
            Route::patch('/{product}/update',[ProductsController::class, 'update'])->name('pr.update')->middleware('permission:pr:edit');
            Route::get('/administrar/tipos', [ProductsController::class, 'getTypes'])->name('pr.index-types');
            Route::get('/administrar/tipos/agregar', [ProductsController::class, 'addTypes'])->name('pr.add-types');
            Route::post('/administrar/tipos/agregar', [ProductsController::class, 'storeType'])->name('pr.store-type');
            Route::get('/administrar/tipos/{type}/editar', [ProductsController::class, 'editType'])->name('pr.edit-type');
            Route::patch('/administrar/tipos/{type}/actualizar', [ProductsController::class, 'updateType'])->name('pr.update-type');
            Route::delete('/administrar/tipos/{type}/delete', [ProductsController::class, 'deleteType'])->name('pr.delete-type');
            Route::get('/administrar/medidas', [ProductsController::class, 'getMeasures'])->name('pr.index-measures');
            Route::get('/administrar/medidas/agregar', [ProductsController::class, 'addMeasures'])->name('pr.add-measures');
            Route::post('/administrar/medidas/agregar', [ProductsController::class, 'storeMeasure'])->name('pr.store-measure');
            Route::get('/administrar/medidas/{measure}/editar', [ProductsController::class, 'editMeasure'])->name('pr.edit-measure');
            Route::patch('/administrar/medidas/{measure}/actualizar', [ProductsController::class, 'updateMeasure'])->name('pr.update-measure');
            Route::delete('/administrar/medidas/{measure}/delete', [ProductsController::class, 'deleteMeasure'])->name('pr.delete-measure');

        });

        Route::group(['prefix' => 'ventas'], function(){
            Route::get('/', [SalesController::class, 'index'])->name('ve.index')->middleware('permission:ve:access');
            Route::get('/pdf/{id}',[SalesController::class, 'pdf'])->name('ve.pdf')->middleware('permission:ve:access');
            Route::get('/{sale}/detalle', [SalesController::class, 'show'])->name('ve.show')->middleware('permission:ve:access');
            Route::get('/generar',[SalesController::class, 'new'])->name('ve.add')->middleware('permission:ve:access');
            Route::post('/generar',[SalesController::class, 'store'])->name('ve.store')->middleware('permission:ve:access');
            Route::post('/cancelar-venta',[SalesController::class, 'cancelSale'])->name('ve.cancel')->middleware('permission:ve:access');
        });

        Route::group(['prefix' => 'documentos-electronicos'], function(){
            Route::get('/', [BillsController::class, 'index'])->name('de.index')->middleware('permission:ve:access');
            Route::get('/{bill}/detalles', [BillsController::class, 'items'])->name('de.items')->middleware('permission:ve:access');
            Route::get('/generar',[BillsController::class, 'new'])->name('de.add')->middleware('permission:ve:access');
            Route::post('/generar',[BillsController::class, 'store'])->name('de.store')->middleware('permission:ve:access');
            Route::post('/cancelar',[BillsController::class, 'calcelBill'])->name('de.cancel')->middleware('permission:ve:access');
        });

        Route::group(['prefix' => 'clientes'], function(){
            Route::get('/',[ClientsController::class, 'index'])->name('cl.index')->middleware('permission:ve:access');
            Route::get('/nuevo',[ClientsController::class, 'new'])->name('cl.add')->middleware('permission:ve:access');
            Route::post('/nuevo',[ClientsController::class, 'store'])->name('cl.store')->middleware('permission:ve:access');
        });

        Route::group(['prefix' => 'reportes'], function(){
            Route::get('/',[ReportesCotroller::class, 'index'])->name('rp.index');
            Route::get('/inventario',[ReportesCotroller::class, 'export'])->name('rp.inventory');
        });

        Route::get('/traslado/{transfer}', [CommonController::class, 'transferDetail'])->name('transfer.details');

        Route::get('/notificaciones-sin-leer', function() {
            return view('components.notifications-panel');
        })->name('unread.notifications');

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
    Route::post('/commons/get-person', [CommonController::class, 'getPerson'])->name('get-person');
    Route::post('/commons/get-bussiness', [CommonController::class, 'getBussiness'])->name('get-bussiness');
    Route::post('/commons/get-product', [CommonController::class, 'getProduct'])->name('get-product');
    Route::get('/api/warehouse/{id}/product/{productId}', [WarehouseController::class, 'getProduct'])->name('wr.get-product');
    Route::get('/api/warehouse/{id}/get-products', [WarehouseController::class, 'getProductsByWarehouse'])->name('wr.get-products');
    //Sales
    Route::get('/api/sales/store/{storeId}/products', [SalesController::class, 'getProductosByStore'])->name('ve.get-products');
    Route::get('/api/sales/clients', [SalesController::class, 'getClients'])->name('ve.get-clients');
     //De
     Route::get('/api/bills/products', [BillsController::class, 'getProducts'])->name('de.get-products');
     Route::get('/api/bills/clients', [BillsController::class, 'getClients'])->name('de.get-clients');
});
