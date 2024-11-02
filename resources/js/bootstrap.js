import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;

import jQuery  from "jquery";
import moment from 'moment';

import {router} from "@inertiajs/vue3";

window.moment = moment;

window.$ = jQuery;
window.jQuery = jQuery;




window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


// axios.defaults.baseURL = 'http://<YOUR-LARAVEL-API-SERVER>/api';

if (localStorage.getItem('token')) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
}
// Handle token expiration or invalid tokens:
axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            // Remove the token from local storage:
            localStorage.removeItem('token');
            // Reset the axios Authorization header:
            axios.defaults.headers.common['Authorization'] = 'Bearer';
            // Redirect the user to the login page:
            router.visit('/login',{ method: 'get' });
        }
        return Promise.reject(error);
    }
);

try {
    window.Popper = require('@popperjs/core');



} catch (e) {}

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
