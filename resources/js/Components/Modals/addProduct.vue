<script setup>

    import { utilityPinia } from "../../store/utility";
    import { productPinia } from "../../store/product.js";
    const storeUtility = utilityPinia();
    const storeProduct = productPinia();


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


        storeProduct.product.image_name = files[0].name;
        console.log("files===",storeProduct.product.image_name);

        let file_contents;
        const file = files[0];

        let isImage =isFileImage(file);
        console.log("isImage===",isImage);
        if( isImage !== -1 ){
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = (event) => {
                file_contents = event.target.result;
                 storeProduct.onCropImage(file_contents, 0, 0, 500, 500);
            };

        }
    })

</script>

<template>


    <div class="modal  add-relation-modal" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">{{$t('Add')}} {{$t('product')}}</h4>

                    <svg class="cursor-pointer" data-bs-dismiss="modal" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.75" y="0.75" width="28.5" height="28.5" rx="7.25" stroke="#111111" stroke-opacity="0.5" stroke-width="1.5" stroke-dasharray="3 3"/>
                        <path d="M19.5 10.5L10.5 19.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.5 10.5L19.5 19.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>

                <div class="modal-form">

                    <div class="custom-form">

                        <div class="form-group">
                            <label for="product_image" class="m_title">{{$t('product')}} {{$t('image')}}</label>
                            <input type="file" class="form-control d-none" id="product_image" placeholder="Enter logo" />
                            <div class="custom-file-picker" @click="open">
                                <span v-if="storeProduct.product.image_name">{{storeProduct.product.image_name}}</span>
                                <span v-else>{{$t('Select')}}</span>
                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.2929 7.36678L8.16621 13.4934C7.41565 14.244 6.39767 14.6657 5.33621 14.6657C4.27475 14.6657 3.25677 14.244 2.50621 13.4934C1.75565 12.7429 1.33398 11.7249 1.33398 10.6634C1.33398 9.60199 1.75565 8.58401 2.50621 7.83344L8.63288 1.70678C9.13325 1.2064 9.81191 0.925293 10.5195 0.925293C11.2272 0.925293 11.9058 1.2064 12.4062 1.70678C12.9066 2.20715 13.1877 2.88581 13.1877 3.59344C13.1877 4.30108 12.9066 4.97973 12.4062 5.48011L6.27288 11.6068C6.02269 11.857 5.68336 11.9975 5.32954 11.9975C4.97572 11.9975 4.6364 11.857 4.38621 11.6068C4.13602 11.3566 3.99547 11.0173 3.99547 10.6634C3.99547 10.3096 4.13602 9.9703 4.38621 9.72011L10.0462 4.06678" stroke="#181818" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product_name">{{$t('Name')}}</label>
                            <input type="text" class="form-control" id="product_name" :placeholder="$t('Enter name')" v-model="storeProduct.product.name" required>
                        </div>

                        <div class="form-group">
                            <label for="product_category">{{$t('Main category')}}</label>
                            <div class="select-wrapper">
                                <select id="product_category" v-model="storeProduct.product.main_category_id">
                                    <template v-if="storeProduct.category_items && storeProduct.category_items[0]">
                                        <template v-for="single in storeProduct.category_items[0].category_items">
                                            <option :value="single.id">{{single.name}}</option>
                                        </template>
                                    </template>
                                </select>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.8754 9.00002L11.9954 12.88L8.11541 9.00002C7.7254 8.61002 7.09541 8.61002 6.70541 9.00002C6.3154 9.39002 6.3154 10.02 6.70541 10.41L11.2954 15C11.6854 15.39 12.3154 15.39 12.7054 15L17.2954 10.41C17.4827 10.2232 17.5879 9.96954 17.5879 9.70502C17.5879 9.4405 17.4827 9.18685 17.2954 9.00002C16.9054 8.62002 16.2654 8.61002 15.8754 9.00002Z" fill="#1B1B1A"/>
                                </svg>

                            </div>
                        </div>
                        <template v-if="storeProduct.category_items">
                            <template v-for="(main_category,index) in storeProduct.category_items">
                               <div class="custom-toggle" v-if="index > 0 && index < storeProduct.category_items.length-1">
                                    <div class="custom-toggle-top">
                                        <label>{{main_category.name}}</label>
                                        <div class="form-check form-switch">
                                            <label class="form-check-label" :for="'mySwitch-'+main_category.id" v-if="storeProduct.onSetCountedSelectedNew(index-1) > 0">

                                                {{ storeProduct.onSetCountedSelectedNew(index-1)}} {{$t('selected')}}
                                            </label>
                                            <input class="form-check-input" type="checkbox" :id="'mySwitch-'+main_category.id" :name="main_category.name" :value="main_category.id" v-model="storeProduct.product.categories[index-1].selected" @change="storeProduct.onMainCategorySelectNew(index-1)" /> <!---->
                                        </div>
                                    </div>

                                    <div class="custom-toggle-checkbox" :id="'sub-category'+main_category.id"  v-if="storeProduct.product.categories[index-1].selected">

                                        <div class="custom-toggle-checkbox-wrapper">

                                            <template v-if="main_category">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" :id="'select-all-'+main_category.id" name="selectAll[]" @change="storeProduct.onSubCategorySelectNewAll(index-1,main_category.category_items)" />
                                                    <label class="form-check-label">{{$t('Select all')}}</label>
                                                </div>
                                                <template v-for="(single,sub_index) in main_category.category_items">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" :id="'main-'+main_category.id+'option-'+single.id" :name="single.name" :value="single.id"  @change="storeProduct.onSubCategorySelectNew(index-1,single.id)" />
                                                        <label class="form-check-label">{{single.name}}</label>
                                                    </div>
                                                </template>
                                            </template>

                                        </div>

                                    </div>

                                </div>
                            </template>
                        </template>

                    </div>

                    <div class="form-divider"></div>

                    <div class="form-btn-container">
                        <a class="btn-large btn-gray cursor-pointer" @click="storeProduct.onCloseModalProduct()">{{$t('Discard')}}</a>
                        <a class="btn-large btn-dark-blue cursor-pointer" @click="storeProduct.onStoreProduct()">{{$t('Save')}}</a>
                    </div>

                </div>

            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
