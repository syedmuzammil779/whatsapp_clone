<script setup>

    import Layout from "../Components/Layout.vue";
    import { utilityPinia } from "../store/utility";

    import { usePage} from '@inertiajs/vue3'

    const storeUtility = utilityPinia();

    import {onMounted} from "vue";
    onMounted(() => {

    });

</script>
<template>
    <Layout>

        <section class="content-container">

            <div class="content-top">
                <div class="content-meta">
                    <h2 class="heading-1 dashboard-heading">{{('Dashboard')}}</h2>
                </div>


            </div>
            <div class="mb-4 text-center">
                Welcome  <b>{{ usePage().props.user ?  usePage().props.user.name : ''}}</b>
            </div>


        </section>

    </Layout>
</template>



<style scoped>

</style>
