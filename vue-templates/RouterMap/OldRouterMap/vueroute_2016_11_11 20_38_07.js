//var _ = require('lodash');

var Vue = require('vue');

//Stre
//import store             from './store/store.js';
//Components
import TopMenu           from './components/menus/TopMenu.vue';
import MySubMenu         from './components/menus/SubMenu.vue';
import MyTable           from './components/crud/Table.vue';
//Security
import UsersView         from './views/security/Users.vue';
import RolesView         from './views/security/Roles.vue';
import AccessRightsView  from './views/security/AccessRights.vue';
import ModulesView     from './views/security/Modules.vue';
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
    //Link_Template Don´t Delete This Line
});


var App = Vue.extend({
  //  store,
    components: { 
        'topmenu': TopMenu,
    }

});

router.start(App, '#app')