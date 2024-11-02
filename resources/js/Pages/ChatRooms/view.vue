<script setup>
    import Echo from 'laravel-echo';
    import Layout from "../../Components/Layout.vue";
    import { utilityPinia } from "../../store/utility";
    import { chatRoomPinia } from "../../store/chatroom";
    import AddChatRoom from "../ChatRooms/addChatRoom.vue";
    import { usePage} from '@inertiajs/vue3'

    const storeUtility = utilityPinia();
    const storeChatRoom = chatRoomPinia();

    import {onMounted} from "vue";
    onMounted(() => {


        let chat_room_id = usePage().props.chat_room_id;
        storeChatRoom.userId = usePage().props.user ? usePage().props.user.id: 0;
        storeChatRoom.viewChatRoom(chat_room_id);

        // storeChatRoom.fetchMessages();

            window.Echo.private(`chat-room.${chat_room_id}`)
                .listen('MessageSent', (event) => {
                    console.log(event.message);
                    storeChatRoom.chat_messages.push(event.message);
                });

    });


</script>
<template>
    <Layout>
        <section class="content-container">
        <h3>{{ storeChatRoom.chatRoom.name }}</h3>

        <div class="chat-messages border p-3 mb-3" style="height: 300px; overflow-y: scroll;">
            <div v-for="message in storeChatRoom.chat_messages" :key="message.id" :class="[message.user_id === storeChatRoom.userId ? 'message text-end':'message']">
                <strong>{{ message.user.name }}:</strong> {{ message.message }}

                <div class="inquiry-product-img" v-if="message.file">
                    <img :src="`/storage/${message.file}`" width="100" height="100" />
                </div>


            </div>
            <div class="clearfix"></div>
        </div>

        <form @submit.prevent="storeChatRoom.sendMessage" class="d-flex">
            <input v-model="storeChatRoom.message" type="text" class="form-control me-2" placeholder="Type a message...">
            <input type="file" @change="storeChatRoom.handleFileUpload" class="form-control mb-2 file-upload" accept="image/*" />
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
        </section>
    </Layout>
</template>

<script>


</script>

<style>
    .chat-messages {
        background-color: #f8f9fa;
    }

    .message {
        padding: 5px 0;

    }
</style>

