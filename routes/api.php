<?php

use App\Http\Controllers\Api\ChatRoomHandler;
use App\Http\Controllers\Api\UserHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::post('logout', [UserHandler::class, 'logout'])->name('logout');

    Route::prefix('chatroom')->group(function () {
        Route::post('create', [ChatRoomHandler::class, 'addChatRoom'])->name('chatroom.store');
        Route::post('view', [ChatRoomHandler::class, 'viewChatRoom'])->name('chatroom.view');
        Route::post('list', [ChatRoomHandler::class, 'listChatRoom'])->name('chatroom.list');
        Route::post('join', [ChatRoomHandler::class, 'joinChatRoom'])->name('chatroom.join');
        Route::post('leave', [ChatRoomHandler::class, 'leaveChatRoom'])->name('chatroom.leave');
        Route::post('get/messages', [ChatRoomHandler::class, 'getChatRoomMessages'])->name('chatroom.messages');
        Route::post('send/message', [ChatRoomHandler::class, 'sendChatRoomMessage'])->name('chatroom.message.send');
    });

});
