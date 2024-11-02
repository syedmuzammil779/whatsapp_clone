<script setup>
    import {contentPinia} from "../../store/content.js";
    import { utilityPinia } from "../../store/utility";

    const storeUtility = utilityPinia();
    const storeContent = contentPinia();
</script>

<template>


    <div class="modal  delete-modal" id="deleteContent">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Delete item</h4>

                    <svg data-bs-dismiss="modal" class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>

                <div class="modal-body">Are you sure you want to delete {{storeContent.category_item.name}}? All associated data will be lost.</div>
                <div class="modal-footer">

                    <div class="modal-footer-buttons">
                        <a  class="btn-large btn-gray cursor-pointer" @click="storeContent.onCloseDeleteCategoryItemModal()">Cancel</a>
                        <a  class="btn-large btn-dark-red cursor-pointer" @click="storeContent.onDeleteCategoryItem()">Delete</a>
                    </div>

                </div>

            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
