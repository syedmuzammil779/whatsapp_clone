<script setup>

import {Link,router} from "@inertiajs/vue3";

import { reactive, ref } from 'vue';

const form = reactive({
    email: '',
    password: ''
});
const message = ref();
function submit() {
    message.value = '';
    axios.post('save/login', form)
        .then(response => {

            if( response.data.code === 1 ){

                message.value = response.data.message;

                localStorage.setItem('token', response.data.token);
                axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
                // router.push({ name: 'user' });
                router.visit('/',{ method: 'get' });
            }

            if( response.data.code === 2 || response.data.code === 0 ){

                message.value = response.data.message;

            }
        })
        .catch(error => {
            if (error.response.status === 422) {
                message.value = error.response.data.message;
            }
        })
        .finally(() => form.password = '');
}

</script>

<template>

    <div class="login-container">

        <div class="login-logo-container">
            WhatsApp clone
        </div>


        <div class="login-form">
            <p v-if="message" class="error">{{ message }}</p>
            <form @submit.prevent="submit" >
            <div class="form-group">
                <label for="login_email">{{('E-mail')}}</label>
                <input type="text" class="form-control" id="login_email" placeholder="Enter e-mail" v-model="form.email">
            </div>

            <div class="form-group">
                <label for="login_password">{{('Password')}}</label>
                <input type="password" class="form-control" id="login_password" placeholder="Enter password" v-model="form.password">
            </div>

                <div class="">
                    <a href="/sign-up" class="btn-large text-end align-items-end float-end mb-4 "> Create new account</a>
                </div>
            <div class="login-form-btn">
                <!--<a href="#" >Login</a>-->
                <button type="submit" class="btn-large btn-dark-blue">{{('Login')}}</button>
            </div>
            </form>


        </div>
        <!--</form>-->


    </div>

</template>

<style scoped>

.login-logo-container {
    background-color: #3A91AA;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    width: 100%;
}

.login-container {
    max-width: 500px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.login-form {
    width: 100%;


}


.login-form {
    width: 100%;
    display: flex;
    font-family: "Gabarito", sans-serif;
    flex-direction: column;
    .form-group {
        width: 100%;
        label {
            font-weight: 500;
            font-size: 12px;
            color: #181818;
            margin-bottom: 8px;
            margin-top: 16px;
        }

        input {
            border-radius: 4px;
            border: 1px solid #00000015;
            height: 42px;
            align-items: center;
            display: flex;
            width: 100%;
            font-size: 14px;
            font-weight: 400;
            color: #181818;
            &::placeholder {
                color: #18181855;

            }
            &[type="text"][disabled] {
                background-color: #F3F3F3;
            }
        }

        .select-wrapper {
            position: relative;
            svg {
                position: absolute;
                right: 10px;
                top: 10px;
                z-index: 9;
            }
            select {
                border-radius: 4px;
                border: 1px solid #00000015;
                height: 42px;
                align-items: center;
                display: flex;
                width: 100%;
                font-size: 14px;
                font-weight: 400;
                color: #181818;
                padding-left: 10px;
                position: relative;
                z-index: 99;
                background-color: transparent;
                -moz-appearance: none;
                -webkit-appearance: none;
                &::-ms-expand {
                    display: none;
                }
            }
        }

    }

    .login-form-btn {
        margin-left: auto;
        margin-top: 16px;
        display: flex;
        gap: 20px;
        width: 100%;
        .btn-large {
            width: 100%;
            max-width: 100%;
        }
    }
}

.error {
    color: red;
    font-size: 1em;
}

</style>
