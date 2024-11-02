<script setup>
    import { Link,usePage } from '@inertiajs/vue3';
    import { utilityPinia } from "../store/utility";

    const storeUtility = utilityPinia();
</script>

<template>


    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast " role="alert" aria-live="assertive" aria-atomic="true">

            <div class="toast-body" style="background-color: #e84141; color: #fff">
                {{storeUtility.errorMessage}}
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>

        </div>
    </div>
    <header class="main-header">

        <Link class="header-logo" href="/" style="color: #1a202c">
            Whatsapp clone
        </Link>

        <div class="header-nav">
            <Link href="/" :class="storeUtility.setActiveNavigationLink('dashboard')" >Dashboard</Link>
            <Link href="/chat-room" :class="storeUtility.setActiveNavigationLink('ChatRooms/index')">Chat rooms</Link>
        </div>

        <Link class="logout-btn" href="/api/logout" method="post" as="button" type="button">
            <svg class="header-logout" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.75" y="0.75" width="28.5" height="28.5" rx="7.25" stroke="white" stroke-opacity="0.5" stroke-width="1.5" stroke-dasharray="3 3"/>
                <path d="M18 18.75L21.75 15L18 11.25" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21.75 15H12.75" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12.75 21.75H9.75C9.35218 21.75 8.97064 21.592 8.68934 21.3107C8.40804 21.0294 8.25 20.6478 8.25 20.25V9.75C8.25 9.35218 8.40804 8.97064 8.68934 8.68934C8.97064 8.40804 9.35218 8.25 9.75 8.25H12.75" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </Link>



    </header>

</template>

<style scoped>

</style>
