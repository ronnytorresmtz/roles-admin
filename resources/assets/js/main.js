
import MyLogin              from '../../components/login/Login.vue';
import MyResetYourPass      from '../../components/login/ResetYourPassword.vue';
import MyPopUp              from '../../components/messages/PopUp.vue';
import MyTopMenu            from '../../components/menus/TopMenu.vue';
import MySubMenu            from '../../components/menus/SubMenu.vue';
import MyButton             from '../../components/crud/Button.vue';
import MyCrudTable          from '../../components/crud/Table.vue';
import MyTableYearMonth     from '../../components/table/TableYearMonth.vue';
import MyTableSearch        from '../../components/table/TableSearch.vue';
import MyForm               from '../../components/crud/Form.vue';
import MyImport             from '../../components/crud/Import.vue';
//import MyLink               from '../../components/crud/Link.vue';
import MyChart              from '../../components/graphs/Chart.vue';
import MyHorizontalLinks    from '../../components/menus/HorizontalLinks.vue';
import MyMessage            from '../../components/messages/Message.vue';


module.exports = {
   
    data: function() {
      return {
       
      };
    },

    components: { 
      'mylogin':           MyLogin,
      'myresetyourpass':   MyResetYourPass,
      'mypopup':           MyPopUp,
    	'mytopmenu':         MyTopMenu,
    	'mycrudbuttons':     MyButton,
    	'mycrudtable':       MyCrudTable,
      'mycrudform':        MyForm,
      'mytableyearmonth':  MyTableYearMonth,
      'mytablesearch':     MyTableSearch,
    	'mysubmenu':         MySubMenu,
      'myimport':          MyImport,
     // 'mylink':            MyLink,
      'mychart':           MyChart,
      'myhorizontallinks': MyHorizontalLinks,
      'mymessage':         MyMessage,
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
    		this.$broadcast('expandCrud');
    	},
      rowSelected: function(row){
        this.$broadcast('displayCrud', true);
        this.$broadcast('displayRow', row);  
      },
      displayAlert: function(type, message){
        this.$broadcast('displayBoxMessage', type, message);
      },
      reloadTable: function(){
        this.$broadcast('reloadData');
      },
      selectFile: function(){
        this.$broadcast('selectImportFile');
      },

    }
  };
