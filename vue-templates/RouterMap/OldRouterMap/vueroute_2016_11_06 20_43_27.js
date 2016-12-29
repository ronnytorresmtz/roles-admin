//var _ = require('lodash');

var Vue = require('vue');

import TopMenu           from './components/menus/TopMenu.vue';
import MySubMenu         from './components/menus/SubMenu.vue';
import MyTable           from './components/crud/Table.vue';
//Facilities
import InstituteView     from './views/facilities/Institute.vue';
import CampusView        from './views/facilities/Campus.vue';
//Academic
import ProgramView       from './views/academic/Program.vue';
import PlanView          from './views/academic/Plan.vue';
//Security
import UsersView         from './views/security/Users.vue';
import RolesView         from './views/security/Roles.vue';
import AccessRightsView  from './views/security/AccessRights.vue';
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
    '/institutes': {    
        component: InstituteView
    },
     '/campus': {
        component: CampusView
    },
    '/program': {
        component: ProgramView
    },
    '/plans': {
        component: PlanView
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
    //Link_Template Don´t Delete This Line
});


var App = Vue.extend({

    components: { 
        'topmenu': TopMenu,
    }

});

router.start(App, '#app')