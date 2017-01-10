var Vue = require('vue');
var VueRouter = require('vue-router');
var VueResource=require('vue-resource');

Vue.use(VueRouter);
Vue.use(VueResource);

//Vue.config.debug = true;

var router = new VueRouter({
  history: false
});

Vue.http.interceptors.push({

//   request: function (request){
//     request.headers['Authorization'] = auth.getAuthHeader()
//     return request
//   },

  response: function (response) {
    if (response.status==401){
        router.app.$route.router.go('/login');
     }
     
    return response;
  }

});


router.map({

    '/': {
        name: 'home',
        component: require('./views/login/LoginView.vue'),
        
    },

    '/login': {
        name: 'login',
        component: require('./views/login/LoginView.vue'),
    },

    '/dashboard': {
        name: 'dashboard',
        component: require('./views/security/UsersLoggedView.vue'),
        
    },

    '/userslogged': {
        name: 'userlogged',
        component: require('./views/security/UsersLoggedView.vue'),
    },

    '/modulesused': {
        name: 'modulesused',
        component: require('./views/security/ModulesUsedView.vue'), 
    },

    '/transactionsused': {
        name: 'transactionsused',
        component: require('./views/security/TransactionsUsedView.vue'), 
    },

    '/actionsused': {
        name: 'actionsused',
        component: require('./views/security/ActionsUsedView.vue'), 
    },

    '/users': {
        name: 'users',
        component: require('./views/security/Users.vue'), 
    },
    '/roles': {
        name: 'roles',
        component: require('./views/security/Roles.vue'), 
    },
    '/accessrights': {
        name: 'accessrights',
        component: require('./views/security/AccessRights.vue'), 
    },
    '/modules': {
        name: 'modules',
        component: require('./views/security/Modules.vue'), 
    },
    '/transactions': {
        name: 'transactions',
        component: require('./views/security/Transactions.vue'), 
    },
    //Link_Template Don´t Delete This Line
});

// router.redirect({
//   '*': '/dashboard'
// });

var App = Vue.extend({
  //  store,
    // components: { 
    //     'topmenu': require('./components/menus/TopMenu.vue'),
    // }

});

router.start(App, '#app');