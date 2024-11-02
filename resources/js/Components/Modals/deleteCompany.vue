<script setup>
    import {companyPinia} from "../../store/company.js";
    const storeCompany = companyPinia();

</script>

<template>


    <div class="modal  delete-modal" id="deleteCompany">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">{{$t('Delete')}} {{$t('company')}}</h4>

                    <svg data-bs-dismiss="modal" class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>

                <div class="modal-body">{{$t('Are you sure you want to delete')}} {{storeCompany.company.name}}? {{$t('All associated data and users will be deleted')}}.</div>
                <div class="modal-footer">

                    <div class="modal-footer-buttons">
                        <a  class="btn-large btn-gray" @click="storeCompany.onClickDeleteCompany()">{{$t('Cancel')}}</a>
                        <a  class="btn-large btn-dark-red" @click="storeCompany.onDeleteCompany()">{{$t('Delete')}}</a>
                    </div>

                </div>

            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
