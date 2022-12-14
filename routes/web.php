<?php

use App\Http\Controllers\Chat\ChatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::get('users',[ChatController::class, 'users']);
    Route::post('/get/conversation',[ChatController::class, 'getConversation']);
    Route::post('/send/message',[ChatController::class, 'sendMessage']);
    Route::post('/get/active/user',[ChatController::class, 'activeUser']);
});
