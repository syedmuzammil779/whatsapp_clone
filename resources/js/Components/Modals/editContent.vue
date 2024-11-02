<script setup>
    import {contentPinia} from "../../store/content.js";
    import { utilityPinia } from "../../store/utility";

    const storeUtility = utilityPinia();
    const storeContent = contentPinia();
</script>

<template>


    <div class="modal  add-content-modal" id="editContent">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Edit item</h4>

                    <svg data-bs-dismiss="modal" class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>


                <div class="modal-form">

                    <div class="custom-form">


                        <div class="form-group">
                            <label for="content_name">Name</label>
                            <input type="text" class="form-control" id="content_name" placeholder="Enter name" v-model="storeContent.category_item.name">
                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <div class="modal-footer-buttons">
                        <a  class="btn-large btn-gray cursor-pointer" @click="storeContent.onCloseUpdateCategoryItemModal()">Cancel</a>
                        <a  class="btn-large btn-dark-blue cursor-pointer" @click="storeContent.onUpdateCategoryItem()">Save</a>
                    </div>

                </div>

            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
