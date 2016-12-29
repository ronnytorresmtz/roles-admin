import MyComponent from './components/Button2.js';
import MyTable from './components/Table3.js';
import MySubMenu from './components/SubMenu2.js';
import MyForm from './components/Form2.js';

new Vue({
    el: '#app',
    data: {
        crudActive: false
    },

    events: {

    	activeCrud: function(value){
    		this.crudActive = value;
    		this.$broadcast('activeWindow');
    	}

    }

   
})