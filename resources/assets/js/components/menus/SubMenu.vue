
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
		  	<h3 class="panel-title">Menu Options </h3> 
		  </div> 
      <div class="list-group " class="cursor-hand" v-for="subOption in subOptions">
         <a  class="list-group-item left-panel-border" style="color:blue" v-link="subOption.method">{{subOption.title}}</a>
      </div>
	</div>
</template>


<script>
  module.exports = {

    props: ['submenu'],

  	data: function(){
  		return{
        subOptions:[],
  			subMenus:{
          "security": {
            "1":{"title":"Dashboard", "method": "/dashboard"},
            "2":{"title":"Modules", "method": "/modules"},
            "3":{"title":"Transactions", "method": "/transactions"},
            "4":{"title":"Roles", "method": "/roles"},
            "5":{"title":"Users", "method": "/users"},
            "6":{"title":"Access Rights", "method": "/accessrights"},
            "7":{"title":"Help", "method": "/help"}
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