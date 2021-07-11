<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TimeSheetController;


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

Route::get('/', [StaffController::class, 'index']);
Route::get('/staff/{id}', [StaffController::class, 'list'])->name('staff.list');

Route::get('/time_sheets', [TimeSheetController::class, 'create'])->name('time_sheet.create');
Route::post('/time_sheets/store', [TimeSheetController::class, 'store'])->name('time_sheet.store');

