
<style scope>

	.cursor-hand{
		cursor: pointer;
	}
  
  .left-panel-border{
    border-top:none;
    border-left:none;
    border-right:none;

  }
  

</style>

<template>
	<div>
	  <div class="panel panel-default">  
		  <div class="panel-heading"> 
		  	<h3 class="panel-title">{{ ts['menuOptions']}}</h3> 
		  </div> 
      <div class="list-group " class="cursor-hand" v-for="subOption in subOptions">
         <a  class="list-group-item left-panel-border" style="color:#428bca" v-link="subOption.method">{{ ts[subOption.title] }}</a>
      </div>
	</div>
</template>


<script>

  import MyLang from '../../components/languages/Languages.vue';

  module.exports = {

    mixins: [MyLang],

    props: ['submenu'],

  	data: function(){
  		return{
        subOptions:[],
  			subMenus:{
          "security": {
            "1":{"title":"dashboard", "method": "/dashboard"},
            "2":{"title":"modules", "method": "/modules"},
            "3":{"title":"transactions", "method": "/transactions"},
            "4":{"title":"roles", "method": "/roles"},
            "5":{"title":"users", "method": "/users"},
            "6":{"title":"accessRights", "method": "/accessrights"},
            "7":{"title":"help", "method": "/help"}
          },
        }
  		}
  	},

    ready: function(){
      var strSubMenus=JSON.stringify(this.subMenus);
      var arraySubMenus=JSON.parse(strSubMenus);
      this.subOptions=arraySubMenus[this.submenu];
    },

  	methods:{

  	}
    
  }
</script>