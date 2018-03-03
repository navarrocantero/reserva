window.axios = require('axios');

window._ = require('lodash');

window.Popper = require('popper.js/dist/umd/popper');

window._ = require('bootstrap');

window.Bootstrap = require('bootstrap/dist/js/bootstrap');

window.$ = window.jQuery = require('jquery/dist/jquery');

window.Dropzone = require('bootstrap4c-dropzone/dist/css/component-dropzone.css');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/do+cs/csrf#csrf-x-csrf-token');
}
