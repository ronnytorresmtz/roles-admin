//var _ = require('lodash');

var Vue = require('vue');


//Store
//import store             from './store/store.js';
//Components

import TopMenu              from './components/menus/TopMenu.vue';
// import MySubMenu         from './components/menus/SubMenu.vue';
// import MyTable           from './components/crud/Table.vue';

//Security
import UsersLoggedView      from './views/security/UsersLoggedView.vue';
import ModulesUsedView      from './views/security/ModulesUsedView.vue';
import TransactionsUsedView from './views/security/TransactionsUsedView.vue';
import ActionsUsedView      from './views/security/ActionsUsedView.vue';
import UsersView            from './views/security/Users.vue';
import RolesView            from './views/security/Roles.vue';
import AccessRightsView     from './views/security/AccessRights.vue';
import ModulesView          from './views/security/Modules.vue';
import TransactionsView     from './views/security/Transactions.vue';
//Component_Template Don´t Delete This Line

var VueResource=require('vue-resource');

Vue.use(VueResource);

var VueRouter = require('vue-router');

Vue.use(VueRouter);

//Vue.config.debug = true;

var router = new VueRouter({
  history: false
});

router.map({
    '/dashboard': {
        component: UsersLoggedView, 
    },

    '/userslogged': {
        component: UsersLoggedView, 
    },

    '/modulesused': {
        component: ModulesUsedView, 
    },

    '/transactionsused': {
        component: TransactionsUsedView, 
    },

    '/actionsused': {
        component: ActionsUsedView, 
    },

    '/users': {
        component: UsersView, 
    },
    '/roles': {
        component: RolesView, 
    },
    '/accessrights': {
        component: AccessRightsView, 
    },
    '/modules': {
        component: ModulesView, 
    },
    '/transactions': {
        component: TransactionsView, 
    },
    //Link_Template Don´t Delete This Line
});


var App = Vue.extend({
  //  store,
    components: { 
        'topmenu': TopMenu,
    }

});

router.start(App, '#app');