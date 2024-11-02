<?php

use App\Http\Controllers\Web\ChatRoomController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[UserController::class,'loginView'])->name('login');
Route::get('sign-up',[UserController::class,'signUpView'])->name('register');
Route::post('save/login',[UserController::class,'login'])->name('login.save');
Route::post('save/register',[UserController::class,'signUp'])->name('register.save');

Route::group(['middleware'=>'auth:sanctum'], function () {

    /*index routs*/
    Route::get('/chat-room', [ChatRoomController::class, 'index'])->name('chatRoom');
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/chatroom/view/{chat_room_id}', [ChatRoomController::class, 'viewChatRoom'])->name('chatRoom.view');


});
