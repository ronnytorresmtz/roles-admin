var Vue = require('vue');
//var app = require('./app');
//new Vue(app).$mount('#app');
//

import MyPopUp from './components/PopUp.vue';
import MyTopMenu from './components/TopMenu.vue';
import MyButton from './components/Button.vue';
import MyTable from './components/Table.vue';
import MySubMenu from './components/SubMenu.vue';
import MyForm from './components/Form.vue';

new Vue({

    el: '#app',

    data: { },

    components: { 
    	//'alert': Alert ,
        'mypopup': MyPopUp,
    	'mytopmenu': MyTopMenu,
    	'mycrud': MyButton,
    	'mytable': MyTable,
    	'mysubmenu': MySubMenu,
    	'myform': MyForm,
    },

    events: {

    	activateCrud: function(val){
    		this.$broadcast('displayCrud', val);
    	},
    	executeAction: function(action){
    		this.$broadcast('displayCrud', true);
    		this.$broadcast(action);
    	},
    	expandCrud: function(){
    		//this.IsCrudExpanded = value;
    		this.$broadcast('expandCrud');
    	},
      rowSelected: function(row){
        this.$broadcast('displayCrud', true);
        this.$broadcast('displayRow', row);  
      },

      displayAlert: function(type, message){
        this.$broadcast('displayBoxMessage', type, message);
      },
    }
});
