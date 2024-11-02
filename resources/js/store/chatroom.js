import { defineStore } from "pinia";
import { utilityPinia } from "./utility.js";
import {router, usePage} from "@inertiajs/vue3";
export const chatRoomPinia = defineStore({
    id: 'chatroom',
    state: () => ({
        lists:[],
        chatRoom:{
            id:0,
            name:'',
        },
        chat_messages:[],
        message:'',
        selectedFile:'',
        userId:0,
    }),
    getters: {

    },
    actions: {

        async onListChatRoom() {
            console.log('onListChatRoom');
            let vm = this;
            vm.fetching = true;
            let data = {}
            axios.post(route('chatroom.list'),data)
                .then((response) => {
                    if( response.data.code === 1 ){
                        const data = response.data;
                        console.log('onListChatRoom===',data);
                        vm.lists = [];
                        vm.lists = data.data;

                        vm.fetching = false;
                    }

                })
        },

        async addChatRoom() {

            console.log('addChatRoom');
            let vm = this;
            vm.fetching = true;

            let url = route('chatroom.store');
            axios.post(url,vm.chatRoom)
                .then((response) => {
                    if( response.data.code === 1 ){
                        const data = response.data;
                        console.log('addChatRoom===',data);
                        vm.fetching = false;
                        vm.onListChatRoom();
                        vm.onCloseAddChatRoomModal();

                    }

                })
        },
        async viewChatRoom(chatroomId) {

            console.log('viewChatRoom');
            let vm = this;
            vm.fetching = true;

            let data = { id:chatroomId} ;
            axios.post(route('chatroom.view'),data)
                .then((response) => {
                    if( response.data.code === 1 ){
                        const data = response.data;
                        console.log('addChatRoom===',data);

                        vm.chatRoom = data.data;
                        vm.fetchMessages();
                        vm.fetching = false;

                    }

                })
        },
        async onJoinChatRoom(chatroomId) {

            console.log('onJoinChatRoom');
            let vm = this;
            vm.fetching = true;

            let data = { chat_room_id:chatroomId,user_id:vm.userId} ;
            axios.post(route('chatroom.join'),data)
                .then((response) => {
                    if( response.data.code === 1 ){
                        const data = response.data;
                        console.log('addChatRoom===',data);

                        utilityPinia().onPageVisitsLink('/chatroom/view/'+chatroomId)

                        vm.fetching = false;

                    }

                })
        },
        async onLeaveChatRoom(chatroomId) {

            console.log('onJoinChatRoom');
            let vm = this;
            vm.fetching = true;

            let data = { chat_room_id:chatroomId,user_id:vm.userId} ;
            axios.post(route('chatroom.leave'),data)
                .then((response) => {
                    if( response.data.code === 1 ){
                        const data = response.data;
                        console.log('addChatRoom===',data);

                        vm.fetching = false;

                    }

                })
        },

        async fetchMessages() {
            console.log('fetchMessages');
            let vm = this;
            vm.fetching = true;
            let data = { chat_room_id: vm.chatRoom.id };
            axios.post(route('chatroom.messages'),data)
                .then((response) => {
                    if( response.data.code === 1 ){
                        const data = response.data;
                        console.log('onListChatRoom===',data);
                        vm.chat_messages = [];
                        vm.chat_messages = data.data;

                        vm.fetching = false;
                    }

                })
        },

        async sendMessage() {

            console.log('sendMessage');
            let vm = this;
            vm.fetching = true;

            const formData = new FormData();
            formData.append('message', vm.message);
            formData.append('chat_room_id', vm.chatRoom.id);
            if ( vm.selectedFile ) {
                formData.append('file', vm.selectedFile);
            }


            // let data = { chat_room_id: vm.chatRoom.id,message:vm.message };
            axios.post(route('chatroom.message.send'),formData)
                .then((response) => {
                    if( response.data.code === 1 ){
                        const data = response.data;
                        console.log('sendMessage===',data);
                        vm.message = '';
                        vm.selectedFile = '';

                        $('.file-upload').val('');
                        vm.chat_messages = data.data;
                        vm.fetching = false;
                    }

                })
        },

        handleFileUpload(event){
            this.selectedFile = event.target.files[0];
        },



        onClickAddChatRoom() {

            utilityPinia().showHideModal('addChatRoom');
        },


        onCloseAddChatRoomModal(){
            this.onClickAddChatRoom();
            this.onInitializeChatRoom();
        },

        onInitializeChatRoom(){

            this.chatRoom = {
                id:0,
                name:'',
            };

        }




    }
});
