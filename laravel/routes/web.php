<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TimeSheetController;
use App\Http\Middleware;


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

// Route::get('/', function () {
//     return view('index');
// });
Route::group(['middleware' => 'basicauth'], function(){

Route::get('/', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staffs/detail/{id}', [StaffController::class, 'detail'])->name('staff.detail_post');
Route::post('/staffs/detail/{id}', [StaffController::class, 'detail'])->name('staff.detail');

Route::get('/staffs', [StaffController::class, 'create'])->name('staff.create');
Route::post('/staffs/store', [StaffController::class, 'store'])->name('staff.store');
Route::post('/staffs/update', [StaffController::class, 'update'])->name('staff.update');
Route::post('/staffs/delete/{id}', [StaffController::class, 'delete'])->name('staff.delete');
Route::get('/staffs/{id}', [StaffController::class, 'edit'])->name('staff.edit');

Route::get('/time_sheets', [TimeSheetController::class, 'create'])->name('time_sheet.create');
Route::post('/time_sheets/store', [TimeSheetController::class, 'store'])->name('time_sheet.store');
Route::post('/time_sheets/update', [TimeSheetController::class, 'update'])->name('time_sheet.update');
Route::post('/time_sheets/delete/{id}', [TimeSheetController::class, 'delete'])->name('time_sheet.delete');
Route::get('/time_sheets/{id}', [TimeSheetController::class, 'edit'])->name('time_sheet.edit');

});
