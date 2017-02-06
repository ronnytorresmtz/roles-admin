<style scoped>

  .links{
    display: inline;
    padding-right: 40px;
  }
 
</style>

<template>
  <div style="padding-bottom:10px">    
      <a class="links" v-for="menu in menus" v-link="menu.initialURL">{{ ts[menu.title] }}</a>
  </div>
</template>

<script>

  import MyLang from '../../components/languages/Languages.vue';

  module.exports = {

   mixins: [MyLang],

   data: function(){
      return{
        menus: []
      }
    },

    ready: function(){
      this.menus=[
        {'title':'userLogged', 'initialURL': '/userslogged'},
        {'title':'modulesUsed', 'initialURL': '/modulesused'},
        {'title':'transactionsUsed', 'initialURL': '/transactionsused'},
        {'title':'actionsUsed', 'initialURL': '/actionsused'}
      ]
    },

    methods: {

    }
   
  }
</script>