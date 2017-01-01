<style scoped>
  .button-size{
    width:70px;
    margin-left:2px;
  }
</style>

<template>
  <div>
    <slot name="message"></slot>
    <slot name="modal-import"></slot>
    <span  v-for="action in actions">
        <a href="{{urlExport}}" class="btn btn-sm btn-primary button-size" v-if="(action.title=='Export') ? true : false">   
          Export
        </a>

       <button v-else id="buttonsId" class="btn btn-sm btn-primary button-size" :disabled="action.disabled" @click.prevent="getActionMethod(action.method)"> 
        {{ action.title }} 
       </button>
    </span>
 </div>
 <br/>
<!--pre>{{ $data | json }}</pre-->
</template>

<script>
  module.exports = {

    props: ['urlExport', 'btnActions'],

    ready: function(){
      this.actions=this.jsonToArray(this.btnActions);

    },

    data: function() {
      return {
        displayCrud: false,
        actions: ''
      }
    },

    methods: {
      Add: function (){
        this.$dispatch('executeAction', 'add');
      },

      Import: function (){
         this.$dispatch('selectFile');
      },

      getActionMethod: function(method){
        switch(method) {
          case 'Add':
              return this.Add();
              break;
          case 'Export':
              return this.Export();
              break;
          case 'Import':
              return this.Import();
              break;
        } 
      },

      jsonToArray: function(data){
        var parsed = JSON.parse(data);
        var arr = [];
        for(var x in parsed){
          arr.push(parsed[x]);
        }

        return arr;
      },
    },
  }
</script>