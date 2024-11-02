<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\ChatRoomUser;
use Illuminate\Http\Request;

class ChatRoomHandler extends Controller
{
    //

    public function addChatRoom(Request $request){


        $user = $request->user();


        $this->validateFields($request, [
            'name' => 'required',
        ]);


        $chatRoom = new ChatRoom();

        $parameters = array(
            'name',
        );


        $this->filledRequestFields($request,$parameters, $chatRoom);
        $chatRoom->user_id = $user->id;
        $chatRoom->save();

        return $this->jsonEncodeMessage(1,__("Successfully stored"),$chatRoom);

    }

    public function viewChatRoom(Request $request){

        $user = $request->user();

        $this->validateFields($request, [
            'id' => 'required',
        ]);


        $chatRoom = ChatRoom::find($request->id);
        return $this->jsonEncodeMessage(1,__("Success"),$chatRoom);


    }
    public function listChatRoom(Request $request){

        $user = $request->user();

        $chatRooms = ChatRoom::all();

        if( $chatRooms->isNotEmpty() ){
            foreach($chatRooms  as $single){
                if( $user->id == $single->user_id ){
                    $single->is_join = 1;
                } else {
                    $single->is_join = ChatRoomUser::where('user_id',$user->id)->where('chat_room_id',$single->id)->exists();
                }

            }
        }
        return $this->jsonEncodeMessage(1,__("Success"),$chatRooms);


    }

    public function joinChatRoom(Request $request){

        $user = $request->user();

        $this->validateFields($request, [
            'user_id' => 'required',
            'chat_room_id' => 'required',
        ]);

        $chatRoomUser = new ChatRoomUser();
        $parameters = array(
            'user_id',
            'chat_room_id',
        );


        $this->filledRequestFields($request,$parameters, $chatRoomUser);
        $chatRoomUser->save();

        return $this->jsonEncodeMessage(1,__("Success"));


    }

    public function leaveChatRoom(Request $request){

        $user = $request->user();

        $this->validateFields($request, [
            'user_id' => 'required',
            'chat_room_id' => 'required',
        ]);

        ChatRoomUser::where('user_id',$request->user_id)->where('chat_room_id',$request->chat_room_id)->delete();

        return $this->jsonEncodeMessage(1,__("Success"));


    }

    public function getChatRoomMessages(Request $request){

        $user = $request->user();

        $this->validateFields($request, [
            'chat_room_id' => 'required',
        ]);

        $chatMessages = ChatMessage::with('user:id,name')->where('chat_room_id',$request->chat_room_id)->get();

        return $this->jsonEncodeMessage(1,__("Success"),$chatMessages);

    }
    public function sendChatRoomMessage(Request $request){

        $user = $request->user();

        $this->validateFields($request, [
            'chat_room_id' => 'required',
        ]);




        $chatMessage = new ChatMessage();
        $parameters = array(
            'message',
            'chat_room_id',
        );




        $filePath = null;
        if ( $request->hasFile('file') ) {

            $request->validate([
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg', // Only allow images, max size 2MB
            ]);

            $filePath = $request->file('file')->store('chat_files', 'public');
            $chatMessage->file = $filePath;
        } else {
            $this->validateFields($request, [
                'message' => 'required',
            ]);
        }


        $this->filledRequestFields($request,$parameters, $chatMessage);
        $chatMessage->user_id = $user->id;
        $chatMessage->save();

        $chatMessage = ChatMessage::with('user:id,name')->where('id',$chatMessage->id)->first();

        broadcast( new MessageSent($chatMessage));

        $chatMessages = ChatMessage::with('user:id,name')->where('chat_room_id',$request->chat_room_id)->get();

        return $this->jsonEncodeMessage(1,__("Success"),$chatMessages);

    }




}
