<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatRoomController extends Controller
{
    //
    public function index(){

        if( ! $this->isAuthenticated() )  return redirect()->route('login');
        return Inertia::render('ChatRooms/index');


    }
    public function viewChatRoom($chat_room_id = 0){

        if( ! $this->isAuthenticated() )  return redirect()->route('login');
        return Inertia::render('ChatRooms/view',compact('chat_room_id'));


    }
}
