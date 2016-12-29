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
import CustomersView     from './views/security/Customers.vue';
//Component_Template Don´t Delete This Line

var VueResource=require('vue-resource');

Vue.use(VueResource);

var VueRouter = require('vue-router');

Vue.use(VueRouter);

var eventHub = new Vue();

var router = new VueRouter({
  history: false,
  routes: [
    { path: '/institutes', component: InstituteView },
    { path: '/campus', component: CampusView },
    { path: '/program', component: ProgramView },
    { path: '/plans', component: PlanView },
    { path: '/users', component: UsersView },
    { path: '/roles', component: RolesView }, 
    { path: '/accessrights', component: AccessRightsView },
    { path: '/customers', component: CustomersView },
    //Link_Template Don´t Delete This Line
  ]
});

var App = Vue.extend({
    components: { 
        'topmenu': TopMenu,
    }
});

new Vue({
  el: '#app',
  router: router
});