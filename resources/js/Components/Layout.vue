<script setup>

import Header from "./Header.vue";
import {Head, usePage} from '@inertiajs/vue3'

import { utilityPinia } from "../store/utility";

const storeUtility = utilityPinia();

storeUtility.getPageTitle();
</script>

<template>

    <Head>
        <title> {{  storeUtility.pageTitle.trim() }} | Vinduesprogram </title>
    </Head>
    <Header />
    <slot />

</template>

<style scoped>

</style>
