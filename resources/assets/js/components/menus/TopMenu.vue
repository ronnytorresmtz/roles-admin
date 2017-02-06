<style scoped>

.logout{
  position: relative;
  padding-left: 53  0px;
}

a{
    cursor: pointer;
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
        <a class="navbar-brand" href="#">{{ ts['appName'] }}</a>
            <ul class="nav navbar-nav" v-show="displayMenu"> 
              <li v-for="menu in menus" >
                <a v-link="menu.initialURL">{{ ts[menu.title] }}</a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right" v-show="displayMenu">
              <li> 
                <a class="logout" @click="logout" style="margin-right:10px" > {{ ts['logout'] }}</a> 
              </li> 
            </ul> 
      </div>
    </nav>
 </div>
</template>

<script>

  import MyLang from '../../components/languages/Languages.vue';


  module.exports = {

  mixins: [MyLang],

  props: ['showMenu'],

   data: function(){
      return{
        menus: [],
        displayMenu: (this.showMenu=="false") ? false : true
      }
    },

    ready: function(){

      this.menus=[
        {'title':'dashboard', 'initialURL': '/dashboard'},
        {'title':'modules', 'initialURL': '/modules'},
        {'title':'transactions', 'initialURL': '/transactions'},
        {'title':'roles', 'initialURL': '/roles'},
        {'title':'users', 'initialURL': '/users'},
        {'title':'accessRights', 'initialURL': '/accessrights'},    
        {'title':'help', 'initialURL': '/help'},
      ]
      
    },

    methods: {

      logout: function(){
        window.location.href = '/login/logOut'; 
      },

      // displayPopUpMessage: function(response){
      //  try{
          //   this.$dispatc('displayAlert', (!response.data.error) ? 'success' : 'danger', response.data.message + ' (' + response.status + ')');
          // }catch(error){
          //   this.$dispatch('displayAlert', 'danger', error.name + ' Exception: ' + error.message);
          // }
      // },
      
    },

  }
</script>