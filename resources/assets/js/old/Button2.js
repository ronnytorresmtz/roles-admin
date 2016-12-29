
var buttons= '<div> <br> <span v-for="action in actions"> <a class="btn btn-sm btn-primary button-size" @click.prevent="action.method">{{action.title}}</a>  </span> </div> <br>  ';

Vue.component('mycrud', {

  template: buttons,
 
  data: function() {
      return {
        open: false,
        actions: [
          {'title': 'View', 'method': this.View},
          {'title': 'Add', 'method': this.Add},
          {'title': 'Edit', 'method': this.Edit},
          {'title': 'Delete', 'method': this.Delete},
          {'title': 'Export', 'method': this.Export}, 
          {'title': 'Import', 'method': this.Import},
        ]
      }
    },

  methods: {
      View: function (){
        alert('hola');
      },
      Add: function (){
        //alert('hola');
        this.open= !this.open;
        this.$dispatch('activeCrud', this.open);
      },
      Edit: function (){
        alert('hola');
      },
      Delete: function (){
        alert('hola');
      },
      Export: function (){
        alert('hola');

      },
      Import: function (){
        alert('hola');
      },
    }
   
});
