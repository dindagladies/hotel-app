<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->group(function(){
    // home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // booking
    Route::resource('/booking', 'BookingController');
    Route::get('/booking/search', 'BookingController@search');
    Route::get('/processbooking', 'BookingController@process');
    Route::get('/donebooking', 'BookingController@done');

    Route::resource('/transaction', 'TransactionController');
    Route::get('/transaction/invoice/{id}', 'TransactionController@invoice');

    Route::resource('/room', 'RoomController');
    Route::get('/room/search', 'RoomController@search');
    
    Route::resource('/datauser', 'DataUserController');
    Route::get('/datauser/search', 'DataUserController@search');

    Route::resource('/history', 'HistoryController');

    // logout
    Route::get('/logoutt', function(){
        Auth::logout();
        redirect('/');
    });
});
