<script setup>
    import { utilityPinia } from "../../store/utility";
    import { manufacturePinia } from "../../store/manufacture.js";
    import {onMounted} from "vue";

    const storeUtility = utilityPinia();
    const storeManufacture = manufacturePinia();

    import { useFileDialog } from '@vueuse/core'


    const { files, open, reset, onChange } = useFileDialog({
        accept: 'image/*'
    });


    function isFileImage(file) {

        console.log('isFileImage');

        const acceptedImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

        return file && $.inArray(file['type'], acceptedImageTypes)
    }


    onChange((files) => {
        /** do something with files */

        console.log("files===",files);


        storeManufacture.manufacture.image_name = files[0].name;
        console.log("files===",storeManufacture.manufacture.image_name);

        let file_contents;
        const file = files[0];

        let isImage =isFileImage(file);
        console.log("isImage===",isImage);
        if( isImage !== -1 ){
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = (event) => {
                file_contents = event.target.result;
                storeManufacture.manufacture.logo = file_contents;
            };

        }
    })

</script>

<template>


    <div class="modal  add-relation-modal" id="addManufacture">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">{{$t('Add')}} {{$t('manufacturer')}}</h4>

                    <svg class="cursor-pointer" data-bs-dismiss="modal" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.75" y="0.75" width="28.5" height="28.5" rx="7.25" stroke="#111111" stroke-opacity="0.5" stroke-width="1.5" stroke-dasharray="3 3"/>
                        <path d="M19.5 10.5L10.5 19.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.5 10.5L19.5 19.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>

                <div class="modal-form">

                    <div class="custom-form">


                        <div class="form-group">
                            <label for="manufacture_logo">{{$t('Logo')}}</label>
                            <input type="file" class="form-control d-none" id="manufacture_logo" placeholder="Enter logo" />
                            <div class="custom-file-picker" @click="open">
                                <span v-if="storeManufacture.manufacture.image_name">{{storeManufacture.manufacture.image_name}}</span>
                                <span v-else>{{$t('Select')}}</span>
                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.2929 7.36678L8.16621 13.4934C7.41565 14.244 6.39767 14.6657 5.33621 14.6657C4.27475 14.6657 3.25677 14.244 2.50621 13.4934C1.75565 12.7429 1.33398 11.7249 1.33398 10.6634C1.33398 9.60199 1.75565 8.58401 2.50621 7.83344L8.63288 1.70678C9.13325 1.2064 9.81191 0.925293 10.5195 0.925293C11.2272 0.925293 11.9058 1.2064 12.4062 1.70678C12.9066 2.20715 13.1877 2.88581 13.1877 3.59344C13.1877 4.30108 12.9066 4.97973 12.4062 5.48011L6.27288 11.6068C6.02269 11.857 5.68336 11.9975 5.32954 11.9975C4.97572 11.9975 4.6364 11.857 4.38621 11.6068C4.13602 11.3566 3.99547 11.0173 3.99547 10.6634C3.99547 10.3096 4.13602 9.9703 4.38621 9.72011L10.0462 4.06678" stroke="#181818" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="manufacture_name">{{$t('Name')}}</label>
                            <input type="text" class="form-control" id="manufacture_name" :placeholder="$t('Enter name')"  v-model="storeManufacture.manufacture.name">
                        </div>

                        <div class="form-group">
                            <label for="manufacture_email">{{$t('E-mail')}}</label>
                            <input type="text" class="form-control" id="manufacture_email" :placeholder="$t('Enter e-mail')" v-model="storeManufacture.manufacture.email">
                        </div>


                        <div class="form-divider"></div>

                        <div class="form-btn-container">
                            <a class="btn-large btn-gray cursor-pointer" @click="storeManufacture.onCloseModal()">{{$t('Discard')}}</a>
                            <a class="btn-large btn-dark-blue cursor-pointer" @click="storeManufacture.onAddManufacture()">{{$t('Save')}}</a>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
