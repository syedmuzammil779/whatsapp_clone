<script setup>
    import { utilityPinia } from "@/store/utility";
    const storeUtility = utilityPinia();

    const props = defineProps({
        column_name: String,
        column_heading: String,
    })
</script>
<template>
    <div class="table-heading-with-sorting" @click="storeUtility.sortingList(props.column_name)">
        <span> {{props.column_heading}}</span>
        <span :class="[{'arrow-down':storeUtility.sortColumn === props.column_name && storeUtility.sortOrder === 'asc'},{'arrow-up':storeUtility.sortColumn === props.column_name && storeUtility.sortOrder === 'desc'},'my-table-sorting-icon']">
                                    <svg width="8" height="6" viewBox="0 0 8 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.20801 0.312019L7.17083 4.75624C7.52526 5.28788 7.14414 6 6.50519 6L1.49481 6C0.855857 6 0.474744 5.28788 0.829173 4.75624L3.79199 0.312019C3.89094 0.163585 4.10906 0.163585 4.20801 0.312019Z" fill="#D2D2D2" />
                                    </svg>
                                    <svg width="8" height="6" viewBox="0 0 8 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.79199 5.68798L0.829173 1.24376C0.474744 0.712116 0.855857 -4.66631e-07 1.49481 -4.59012e-07L6.50519 -3.99264e-07C7.14414 -3.91644e-07 7.52526 0.712115 7.17083 1.24376L4.20801 5.68798C4.10906 5.83641 3.89094 5.83641 3.79199 5.68798Z" fill="#D2D2D2"/>
                                    </svg>
          </span>
    </div>
</template>



<style scoped>

</style>
