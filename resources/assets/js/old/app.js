

/*import Alert from './components/Alert.vue';
import MyButton from './components/Button.vue';
import MyTable from './components/Table.vue';
import MyForm from './components/Form.vue';


new Vue ({
    components: { 
    	'alert': Alert ,
    	'mybutton': MyButton,
    	'mytable': MyTable,
    	'myform': MyForm,
    }
});*/



import MyComponent from './components/Button.vue';
import MyTable from './components/Table.vue';
import MySubMenu from './components/SubMenu.vue';
import MyForm from './components/Form.vue';

new Vue({

    el: '#app',

    data: {
        crudActive: false
    },

    components: { 
    	'alert': Alert,
    	'mybutton': MyButton,
    	'mytable': MyTable,
    	'myform': MyForm,
    },

    events: {

    	activeCrud: function(value){
    		this.crudActive = value;
    		this.$broadcast('activeWindow');
    	}

    }
   
});