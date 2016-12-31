<style scoped>
 
</style>

<template>

<head>
    <link rel="icon" 
      type="image/png" 
      href="/assets/icons/loading_image.gif" />
    </head>
  <div>
    


    <nav class="navbar navbar-default">
      <div class="container-fluid" >
        <a class="navbar-brand" href="#">MegaCampus</a>
        <ul class="nav navbar-nav"   v-for="menu in menus"> 
          <li>
            <a v-link="menu.initialURL">{{menu.title}}</a>
          </li>
        </ul>
      </div>
    </nav>
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
        {'title':'Dashboard', 'initialURL': '/'},
        {'title':'Facilities', 'initialURL': '/institutes'},
        {'title':'Academic', 'initialURL': '/plans'},
        {'title':'Resources', 'initialURL': '/'},
        {'title':'Inventory', 'initialURL': '/'},
        {'title':'Assets', 'initialURL': '/'},
        {'title':'Services', 'initialURL': '/'},
       
        {'title':'Treasury', 'initialURL': '/'},
        {'title':'Security', 'initialURL': '/users'},
        {'title':'Settings', 'initialURL': '/'},
        {'title':'Data', 'initialURL': '/'},
      ]
    },

    methods: {

      facilities: function(){
          alert('facilities');
      },

      academic: function(){
          alert('academic');
      },

      treasury: function(){
          alert('treasury');
      },

      security: function(){
          alert('security');
      },

      configuration: function(){
          alert('configuration');
      },
    }
   
  }
</script>