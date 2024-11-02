<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat-room.{chatRoomId}', function ($user, $chatRoomId) {
//    return $user->chatRoomsUsers->contains($chatRoomId);
    return true;
});

//Broadcast::channel('chat.{id}', function ($user, $id) {
//    return $user->id == $id;
////    return true;
//});
