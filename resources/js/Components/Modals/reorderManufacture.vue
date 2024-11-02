<script setup>
    import { utilityPinia } from "../../store/utility";
    import { manufacturePinia } from "../../store/manufacture.js";
    const storeUtility = utilityPinia();
    const storeManufacture = manufacturePinia();


    $( function() {

        $("#sortableManufacturer").sortable({
            update: function (event, ui) {
                let data = $(this).sortable('serialize');
                storeManufacture.manufacture_sort = data;
                // storeManufacture.onSortManufacture(data);
                console.log("call sortableManufacturer 2",data);

            }
        });

    });

</script>

<template>


    <div class="modal reorder-modal" id="reorderManufacture">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">{{$t('Reorder manufacturers in the app')}}</h4>

                    <svg data-bs-dismiss="modal" class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>


                <div class="reorder-modal-container" id="sortableManufacturer">

                    <template v-if="storeManufacture.lists">
                        <template  v-for="single in storeManufacture.lists" :key="single.id">
                    <div class="reorder-modal-item ui-state-default" :id="'item-'+single.id" >
                        <div>{{single.name}}</div>
                        <svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.74967 0.333252C1.55801 0.333252 0.583008 1.30825 0.583008 2.49992C0.583008 3.69159 1.55801 4.66659 2.74967 4.66659C3.94134 4.66659 4.91634 3.69159 4.91634 2.49992C4.91634 1.30825 3.94134 0.333252 2.74967 0.333252ZM0.583008 8.99992C0.583008 7.80825 1.55801 6.83325 2.74967 6.83325C3.94134 6.83325 4.91634 7.80825 4.91634 8.99992C4.91634 10.1916 3.94134 11.1666 2.74967 11.1666C1.55801 11.1666 0.583008 10.1916 0.583008 8.99992ZM2.74967 17.6666C3.94134 17.6666 4.91634 16.6916 4.91634 15.4999C4.91634 14.3083 3.94134 13.3333 2.74967 13.3333C1.55801 13.3333 0.583008 14.3083 0.583008 15.4999C0.583008 16.6916 1.55801 17.6666 2.74967 17.6666ZM11.4163 2.49992C11.4163 3.69159 10.4413 4.66659 9.24967 4.66659C8.05801 4.66659 7.08301 3.69159 7.08301 2.49992C7.08301 1.30825 8.05801 0.333252 9.24967 0.333252C10.4413 0.333252 11.4163 1.30825 11.4163 2.49992ZM9.24967 6.83325C8.05801 6.83325 7.08301 7.80825 7.08301 8.99992C7.08301 10.1916 8.05801 11.1666 9.24967 11.1666C10.4413 11.1666 11.4163 10.1916 11.4163 8.99992C11.4163 7.80825 10.4413 6.83325 9.24967 6.83325ZM7.08301 15.4999C7.08301 14.3083 8.05801 13.3333 9.24967 13.3333C10.4413 13.3333 11.4163 14.3083 11.4163 15.4999C11.4163 16.6916 10.4413 17.6666 9.24967 17.6666C8.05801 17.6666 7.08301 16.6916 7.08301 15.4999Z" fill="#262626"/>
                        </svg>
                    </div>
                        </template>
                    </template>

                </div>

                <div class="modal-footer">

                    <div class="modal-footer-buttons">
                        <a  class="btn-large btn-gray" @click="storeManufacture.onClickReorder">{{$t('Cancel')}}</a>
                        <a  class="btn-large btn-dark-blue" @click="storeManufacture.onSortManufacture()">{{$t('Save')}}</a>
                    </div>

                </div>

            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
