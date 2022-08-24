require('./bootstrap');


import { createApp } from 'vue'

import HelloWorld from './components/Welcome.vue';

const app = createApp({});

app.component('hello-world', HelloWorld)

app.mount('#app')


// https://techvblogs.com/blog/how-to-install-vue3-laravel