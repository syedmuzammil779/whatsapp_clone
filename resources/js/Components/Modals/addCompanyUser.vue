<script setup>
    import {companyPinia} from "../../store/company.js";
    import { utilityPinia } from "../../store/utility";

    const storeUtility = utilityPinia();
    const storeCompany = companyPinia();
</script>

<template>


    <div class="modal  add-relation-modal" id="addCompanyUser">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">{{$t('Add')}} {{$t('user')}}</h4>

                    <svg class="cursor-pointer" @click="storeCompany.onCloseModal()" data-bs-dismiss="modal" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.75" y="0.75" width="28.5" height="28.5" rx="7.25" stroke="#111111" stroke-opacity="0.5" stroke-width="1.5" stroke-dasharray="3 3"/>
                        <path d="M19.5 10.5L10.5 19.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.5 10.5L19.5 19.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>

                <div class="modal-form">

                    <div class="custom-form">

                        <div class="form-group">
                            <label for="user_name">{{$t('Full name')}}</label>
                            <input type="text" class="form-control" id="user_name" :placeholder="$t('Enter name')" v-model="storeCompany.company_user.name">
                        </div>

                        <div class="form-group">
                            <label for="user_email">E-mail</label>
                            <input type="text" class="form-control" id="user_email" :placeholder="$t('Enter e-mail')" v-model="storeCompany.company_user.email">
                        </div>

                        <div class="form-group">
                            <label for="user_phone">{{$t('Phone number')}}</label>
                            <input type="text" class="form-control" id="user_phone" :placeholder="$t('Enter phone number')" v-model="storeCompany.company_user.phone_number">
                        </div>

                        <div class="form-divider"></div>

                        <div class="form-btn-container">
                            <a class="btn-large btn-gray" @click="storeCompany.onCloseModal()">{{$t('Discard')}}</a>
                            <a class="btn-large btn-dark-blue" @click="storeCompany.onAddCompanyUser()">{{$t('Save')}}</a>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
