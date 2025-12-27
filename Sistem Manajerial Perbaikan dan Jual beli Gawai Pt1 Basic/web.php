<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModelController;

Route::get('/', [ModelController::class, 'index'])->name('home');


Route::get('/customer/{locale?}', [ModelController::class, 'customer'])->name('customer');
Route::get('/customer/create/{locale?}', [ModelController::class, 'createcustomer'])->name('createcustomer');
Route::post('/savecustomer', [ModelController::class, 'savecustomer'])->name('savecustomer');
Route::get('/customer/edit/{id}/{locale?}', [ModelController::class, 'editcustomer'])->name('editcustomer');
Route::post('/updatecustomer/{id}', [ModelController::class, 'updatecustomer'])->name('updatecustomer');
Route::post('/deletecustomer/{id}', [ModelController::class, 'deletecustomer'])->name('deletecustomer');


Route::get('/barang/{locale?}', [ModelController::class, 'barang'])->name('barang');
Route::get('/barang/create/{locale?}', [ModelController::class, 'createbarang'])->name('createbarang');
Route::post('/savebarang', [ModelController::class, 'savebarang'])->name('savebarang');
Route::get('/barang/edit/{id}/{locale?}', [ModelController::class, 'editbarang'])->name('editbarang');
Route::post('/barang/update/{id}', [ModelController::class, 'updatebarang'])->name('updatebarang');
Route::post('/barang/delete/{id}', [ModelController::class, 'deletebarang'])->name('deletebarang');


Route::get('/penjualan/{locale?}', [ModelController::class, 'penjualan'])->name('penjualan');
Route::get('/penjualan/create/{locale?}', [ModelController::class, 'createpenjualan'])->name('createpenjualan');
Route::post('/penjualan/save', [ModelController::class, 'savepenjualan'])->name('savepenjualan');
Route::post('/penjualan/delete/{id}', [ModelController::class, 'deletepenjualan'])->name('deletepenjualan');
Route::get('/penjualan/edit/{id}/{locale?}', [ModelController::class, 'editpenjualan'])->name('editpenjualan');
Route::post('/penjualan/update/{id}', [ModelController::class, 'updatepenjualan'])->name('updatepenjualan');

Route::get('/service/{locale?}', [ModelController::class, 'service'])->name('service');
Route::get('/service/create/{locale?}', [ModelController::class, 'createService'])->name('createService');
Route::post('/service/save', [ModelController::class, 'saveService'])->name('saveService');
Route::get('/service/edit/{id}/{locale?}', [ModelController::class, 'editService'])->name('editService');
Route::post('/service/update/{id}', [ModelController::class, 'updateService'])->name('updateService');
Route::post('/service/delete/{id}', [ModelController::class, 'deleteService'])->name('deleteService');

Route::get('/master-service/{locale?}', [ModelController::class, 'masterService'])->name('masterService');
Route::get('/master-service/create/{locale?}', [ModelController::class, 'createMasterService'])->name('masterService.create');
Route::post('/master-service/store', [ModelController::class, 'storeMasterService'])->name('masterService.store');
Route::get('/master-service/edit/{id}/{locale?}',  [ModelController::class, 'editMasterService'])->name('masterService.edit');
Route::post('/master-service/update/{id}',  [ModelController::class, 'updateMasterService'])->name('masterService.update');
Route::post('/master-service/delete/{id}',  [ModelController::class, 'deleteMasterService'])->name('masterService.delete');

Route::get('/laporan/penjualan/{locale?}', [ModelController::class, 'laporanPenjualan'])->name('laporan.penjualan');

Route::get('/laporan/service/{locale?}', [ModelController::class, 'laporanService'])->name('laporanService');

Route::get('/laporan/pendapatan/{locale?}', [ModelController::class, 'laporanPendapatan'])->name('laporan.pendapatan');

Route::get('/laporan/top-customer/{locale?}',[ModelController::class, 'topCustomer'])->name('topCustomer');


