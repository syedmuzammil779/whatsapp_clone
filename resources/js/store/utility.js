import { defineStore } from "pinia";
import { Toast,Modal } from "bootstrap";
import {router, usePage} from '@inertiajs/vue3'

export const utilityPinia = defineStore({
    id: 'utility',
    state: () => ({
        errorsLog:[],
        pageTitle:"Login",
        pagination:{
            current_page:1,
            total:0,
            from:0,
            to:0,
            per_page:25,
            last_page:1,
        },
        errorMessage:'',
        search:'',
        currentTimer:null,
        sortOrder:'desc',
        sortColumn:'id'

    }),
    getters: {
        formatDateTime: (state) => ( dateTime,format='DD MMM YYYY' ) => {
            if( state.timezone ){
                return  moment(dateTime).tz(state.timezone).format(format);
            } else {
                return  moment(dateTime).format( format )
            }
        },
        pageNums: (state) => () => {
            return state.onPaginate(state.pagination.current_page, state.pagination.last_page, 4);
        },
    },
    actions: {

        async getPageTitle() {

            let pageTitle = usePage().url;
            let str = pageTitle.split('/')[1];

            if( str.length === 0){
                str = 'dashboard';
            }

            pageTitle = str.charAt(0).toUpperCase() + str.slice(1);

            this.pageTitle = pageTitle;
            this.search = '';

        },

        async setPagination( pagination ) {

            //console.log("setPagination");
            this.pagination.current_page = pagination.current_page;
            this.pagination.last_page =pagination.last_page;
            this.pagination.total = pagination.total;
            this.pagination.from = pagination.from;
            this.pagination.to = pagination.to;
            this.pagination.per_page = pagination.per_page;


        },
        async searchFilter( page_number =1 ) {

            let vm = this;
            vm.pagination.current_page = page_number;
            vm.onFilterPage();

        },

        async onFilterPage(type=0){

            console.log("onFilterPage",usePage().component);


        },

        async onSearchInput() {
            console.log("onSearchInput");
            let vm = this;
            if ( ! vm.currentTimer) {
                vm.currentTimer = true;
                setTimeout(function() {
                    if (vm.currentTimer) {
                        vm.currentTimer = null;
                        vm.searchFilter(1);
                    }
                }, 2000);
            }
        },

        async sortingList( sortColumn , type= 1){

            let vm = this;
            vm.sortOrder = vm.sortOrder === 'asc' ? 'desc':'asc';

            if( vm.sortColumn !== sortColumn  ){
                vm.sortOrder = 'asc';
            }

            vm.sortColumn = sortColumn;
            vm.onFilterPage();

        },

        onPaginate(current_page, last_page, onSides = 1) {
            // pages
            let pages = [];
            // Loop through
            for (let i = 1; i <= last_page; i++) {

                let temp = current_page - i;
                if (temp < 0)
                    temp*= -1;

                let initialShowing = 3;

                if (i <=initialShowing || (last_page - i) <initialShowing) {

                    pages.push(i);
                } else if (temp <2) {

                    pages.push(i);

                } else if ( temp == 3) {

                    pages.push("...");
                }

            }
            return pages;
        },


        async onPageVisitsLink(url=''){

            console.log("onPageVisitsLink");
            console.log(url);
            router.visit(url,{ method: 'get' });
        },
        async showHideModal(idElement,ObjectID=0,type='') {

            console.log('showHideModal  idElement == ' + idElement);
            console.log('showHideModal  ObjectID == ' + ObjectID);
            console.log('showHideModal  type == ' + type);

            let myModalEl = document.getElementById(idElement);

            let options = {
                focus:true,

            };

            let myModal = Modal.getOrCreateInstance(myModalEl,options);
            myModal.toggle();

            myModalEl.addEventListener('hidden.bs.modal', event => {
                console.log("close modal");
                // history.back();
            });

            myModalEl.addEventListener('show.bs.modal', event => {
                console.log("show modal");

            });
            this.errorsLog = [];

        },


        setActiveNavigationLink($componentName){

            // console.log("setActiveNavigationLink",$componentName,usePage().component);
            return usePage().component === $componentName ? 'active':''
        },

        onShowList(elementID) {

             $('.option-drop-down').not('#'+elementID).removeClass('active')
             $('#'+elementID).addClass('active');

        },
        onShowToast(elementID=''){
            const toastLiveExample = document.getElementById('liveToast')

            const toastBootstrap = Toast.getOrCreateInstance(toastLiveExample);
            toastBootstrap.show();
        },
         onlyUnique(value, index, array) {
            return array.indexOf(value) === index;
       },
        popstate(){

            const modals = document.querySelectorAll('.modal');
            if (modals.length > 0) {
                modals.forEach(function(modal) {
                    let bootstrapModal = Modal.getOrCreateInstance(modal);
                    bootstrapModal.hide();
                });
            }

        },

    },
})

window.addEventListener('popstate', function(event) {
    if (event.state) {
        if( $(".modal").hasClass('show')){
            utilityPinia().popstate();
        }
    } else {
        console.log('Back to the initial state');
    }
});

