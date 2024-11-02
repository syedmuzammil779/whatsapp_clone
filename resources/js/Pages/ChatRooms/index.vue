<script setup>
    import Layout from "../../Components/Layout.vue";
    import { utilityPinia } from "../../store/utility";
    import { chatRoomPinia } from "../../store/chatroom";
    import AddChatRoom from "../ChatRooms/addChatRoom.vue";


    const storeUtility = utilityPinia();
    const storeChatRoom = chatRoomPinia();

    import {onMounted} from "vue";
    import {usePage} from "@inertiajs/vue3";
    onMounted(() => {
        storeChatRoom.userId = usePage().props.user ? usePage().props.user.id: 0;
        storeChatRoom.onListChatRoom();
    });
</script>

<template>
    <Layout>

        <section class="content-container">

            <div class="content-top">

                <div class="content-meta">
                    <h2 class="heading-1">{{('Chat room')}}</h2>
                </div>
                <div class="top-buttons-container">

                    <a @click="storeChatRoom.onClickAddChatRoom()"  class="btn-small btn-transparent-blue">{{('Add')}}</a>

                </div>
            </div>

            <template v-if="storeChatRoom.lists && storeChatRoom.lists.length > 0">
            <div class="table-wrapper">
                <table class="content-table-main">
                    <thead>
                    <tr>
                        <th>{{('Name')}}</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>

                        <tr v-for="single in storeChatRoom.lists" >
                            <td class="cursor-pointer" @click="single.is_join && storeUtility.onPageVisitsLink('/chatroom/view/'+single.id+'')">
                                <h4>{{single.name}}</h4>
                            </td>
                            <td class="cursor-pointer">
                                <span class="flex d-flex align-items-end text-end" v-if="! single.is_join" @click="storeChatRoom.onJoinChatRoom(single.id)">{{('Join')}}</span>
                                <span class="flex d-flex align-items-end text-end" v-if="single.is_join" @click="storeChatRoom.onLeaveChatRoom(single.id)">{{('Leave')}}</span>
                            </td>
                        </tr>


                    </tbody>

                </table>
            </div>
            </template>

        </section>

    </Layout>
    <AddChatRoom />
</template>

<style scoped>

</style>
