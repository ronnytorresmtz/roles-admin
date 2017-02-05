import { } from '../js/bootstrap.js';

var router = new VueRouter({
  history: false
})

router.beforeEach(function (transition) {
    if (transition.to.auth){
        axios.get('login/userAuthenticated').then(function(response){
            if (response.data=='OK'){
                transition.next();
            }else{  
                router.go('/login');
                transition.next();
            }
        }).catch(function (response) {
            alert (response.status + '-' + response.statusText);
            transition.abort();
        });
    }
    else{
       transition.next(); 
    }
});

router.map({

    '/': {
        name: 'home',
        component: require('./views/login/LoginView.vue'),
        auth: false
    },

    '/login': {
        name: 'login',
        component: require('./views/login/LoginView.vue'),
        auth: false
    },

    '/resetYourPassword': {
        name: 'resetYourPassword',
        component: require('./views/login/ResetYourPasswordView.vue'),
        auth: false
    },

    '/dashboard': {
        name: 'dashboard',
        component: require('./views/security/UsersLoggedView.vue'),
        auth: true
    },

    '/userslogged': {
        name: 'userlogged',
        component: require('./views/security/UsersLoggedView.vue'),
        auth: true
    },

    '/modulesused': {
        name: 'modulesused',
        component: require('./views/security/ModulesUsedView.vue'), 
        auth: true
    },

    '/transactionsused': {
        name: 'transactionsused',
        component: require('./views/security/TransactionsUsedView.vue'), 
        auth: true
    },

    '/actionsused': {
        name: 'actionsused',
        component: require('./views/security/ActionsUsedView.vue'), 
        auth: true
    },

    '/users': {
        name: 'users',
        component: require('./views/security/Users.vue'), 
        auth: true
    },
    '/roles': {
        name: 'roles',
        component: require('./views/security/Roles.vue'), 
        auth: true
    },
    '/accessrights': {
        name: 'accessrights',
        component: require('./views/security/AccessRights.vue'), 
        auth: true
    },
    '/modules': {
        name: 'modules',
        component: require('./views/security/Modules.vue'), 
        auth: true
    },
    '/transactions': {
        name: 'transactions',
        component: require('./views/security/Transactions.vue'), 
        auth: true
    },
    //Link_Template Don´t Delete This Line
});

router.redirect({
  '*': '/'
});


var App = Vue.extend({ });

router.start(App, '#app');