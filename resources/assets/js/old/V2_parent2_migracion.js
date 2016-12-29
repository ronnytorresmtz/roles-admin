
import MyPopUp        from '../../components/messages/PopUp.vue';
import MyTopMenu      from '../../components/menus/TopMenu.vue';
import MySubMenu      from '../../components/menus/SubMenu.vue';
import MyButton       from '../../components/crud/Button.vue';
import MyTable        from '../../components/crud/Table.vue';
import MyForm         from '../../components/crud/Form.vue';
import MyImport       from '../../components/crud/Import.vue';
import MyLink         from '../../components/crud/Link.vue';


module.exports = {
   
    data: function() {
      return {
       
      }
    },

    components: { 
      'mypopup':        MyPopUp,
    	'mytopmenu':      MyTopMenu,
    	'mycrud':         MyButton,
    	'mytable':        MyTable,
    	'mysubmenu':      MySubMenu,
    	'myform':         MyForm,
      'myimport':       MyImport,
      'mylink':         MyLink,
    },

    events: {
    	activateCrud: function(val){
    		eventHub.$on('displayCrud', val);
    	},
    	executeAction: function(action){
    		eventHub.$on('displayCrud', true);
    		eventHub.$on(action);
    	},
    	expandCrud: function(){
    		eventHub.$on('expandCrud');
    	},
      rowSelected: function(row){
        eventHub.$on('displayCrud', true);
        eventHub.$on('displayRow', row);  
      },
      displayAlert: function(type, message){
        eventHub.$on('displayBoxMessage', type, message);
      },
      reloadTable: function(){
        eventHub.$on('reloadData');
      },
      selectFile: function(){
        eventHub.$on('selectImportFile');
      },
    

    }
  }
