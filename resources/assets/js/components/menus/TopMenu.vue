<style scoped>

.logout{
  position: relative;
  padding-left: 53  0px;
}
 
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
        <a class="navbar-brand" href="#">Roles Admin</a>
            <ul class="nav navbar-nav"   > 
              <li v-for="menu in menus">
                <a v-link="menu.initialURL">{{menu.title}}</a>
              </li>
              <li> 
                <a href="#" class="logout"> Logout </a> 
              <li> 
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
        {'title':'Dashboard', 'initialURL': '/dashboard'},
        {'title':'Modules', 'initialURL': '/modules'},
        {'title':'Transactions', 'initialURL': '/transactions'},
        {'title':'Roles', 'initialURL': '/roles'},
        {'title':'Users', 'initialURL': '/users'},
        {'title':'Access Rights', 'initialURL': '/accessrights'},    
        {'title':'Help', 'initialURL': '/help'}
      ]
      
      this.$route.router.go('/dashboard');
    },

    methods: {
      
    }
   
  }
</script>