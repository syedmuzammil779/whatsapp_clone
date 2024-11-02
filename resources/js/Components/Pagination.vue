<script setup>
    import { utilityPinia } from "@/store/utility";
    const storeUtility = utilityPinia();
</script>
<template>
    <div class="table-pagination" v-if="storeUtility.pagination.total > 24">

        <div class="per-page">
            <span class="pagination-gray-text">{{$t('Show per page')}}:</span>
            <select  @change="storeUtility.searchFilter(1)" v-model.lazy.number="storeUtility.pagination.per_page">
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        <div class="page-summary">
            <span class="pagination-gray-text">
            {{ storeUtility.pagination.from ? storeUtility.pagination.from : 0 }}-{{ storeUtility.pagination.to ? storeUtility.pagination.to : 0 }}
            {{$t('of')}} {{ storeUtility.pagination.total }} {{$t('items')}}
                </span>
        </div>

        <div class="pagination-nav">
            <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg" @click="
                storeUtility.pagination.current_page > 1 &&
                  storeUtility.searchFilter(storeUtility.pagination.current_page - 1)
              ">
                <path d="M6.74994 2.44771L3.19327 6.00437L6.74994 9.56104C7.10744 9.91854 7.10744 10.496 6.74994 10.8535C6.39244 11.211 5.81494 11.211 5.45744 10.8535L1.24994 6.64604C0.892442 6.28854 0.892442 5.71104 1.24994 5.35354L5.45744 1.14604C5.6287 0.974393 5.86122 0.87793 6.10369 0.87793C6.34617 0.87793 6.57868 0.974393 6.74994 1.14604C7.09827 1.50354 7.10744 2.09021 6.74994 2.44771Z" fill="#1B1B1A" fill-opacity="0.5"/>
            </svg>

            <template v-for="(single_page,i) in storeUtility.pageNums()" :key="i">
                <a
                    @click="storeUtility.searchFilter(single_page)"
                    :class="[
                { 'active': storeUtility.pagination.current_page === single_page },
                'pagination-nav-link cursor-pointer',
              ]"

                >{{ single_page }}</a
                >
            </template>

            <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg" @click="storeUtility.pagination.last_page > 1 && storeUtility.pagination.current_page < storeUtility.pagination.last_page && storeUtility.searchFilter(storeUtility.pagination.current_page + 1)">
                <path d="M1.25006 2.44771L4.80673 6.00437L1.25006 9.56104C0.892559 9.91854 0.892559 10.496 1.25006 10.8535C1.60756 11.211 2.18506 11.211 2.54256 10.8535L6.75006 6.64604C7.10756 6.28854 7.10756 5.71104 6.75006 5.35354L2.54256 1.14604C2.3713 0.974393 2.13878 0.87793 1.89631 0.87793C1.65383 0.87793 1.42132 0.974393 1.25006 1.14604C0.901725 1.50354 0.892559 2.09021 1.25006 2.44771Z" fill="#1B1B1A" fill-opacity="0.5"/>
            </svg>


        </div>
    </div>
</template>



<style scoped>

</style>
