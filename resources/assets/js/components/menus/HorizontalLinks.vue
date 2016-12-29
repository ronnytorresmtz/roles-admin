<style scoped>

  .links{
    display: inline;
    padding-right: 40px;
  }
 
</style>

<template>
  <div style="padding-bottom:10px">    
      <a class="links" v-for="menu in menus" v-link="menu.initialURL">{{menu.title}}</a>
  </div>
</template>

<script>
  module.exports = {
   data: function(){
      return{
        menus: []
      }
    },

    ready: function(){
      this.menus=[
        {'title':'User Logged', 'initialURL': '/userslogged'},
        {'title':'Modules Used', 'initialURL': '/modulesused'},
        {'title':'Transactions Used', 'initialURL': '/transactionsused'},
        {'title':'Actions Used', 'initialURL': '/actionsused'}
      ]
    },

    methods: {

      userlogged: function(){
          alert('facilities');
      },

      modulesused: function(){
          alert('academic');
      },

      transactionsused: function(){
          alert('treasury');
      },

      actionsused: function(){
          alert('security');
      },
    }
   
  }
</script>