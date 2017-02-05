window.Vue = require('vue');

window.VueRouter = require('vue-router');

window.axios = require('axios');

Vue.prototype.$http = axios;

Vue.use(VueRouter);

Vue.config.debug = false;

// axios.interceptors.request.use(function(config){
//     config.headers['X-CSRF-TOKEN'] = Laravel.csrfToken
//     return config;
// })




