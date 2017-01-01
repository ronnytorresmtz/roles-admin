
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
          "facilities": {
            "0":{"title":"Institutes", "method": "/institutes"},
            "1":{"title":"Campus", "method": "/campus"},
            "2":{"title":"Buildings", "method": "/bulgings"},
            "3":{"title":"Deparments", "method": "/deparments"},
            "4":{"title":"Offices", "method": "/offices"},
            "5":{"title":"Classrooms", "method": "/classrooms"},
            "6":{"title":"Courts", "method": "/Courts"},
            "7":{"title":"Warehouses", "method": "/warehouses"},
            "8":{"title":"Help", "method": "/help"}
          },
          "academic": {
            "0":{"title":"Cycles", "method": "/cycles"},
            "1":{"title":"Level", "method": "/levels"},
            "2":{"title":"Plans", "method": "/plans"},
            "3":{"title":"Programs", "method": "/program"},
            "4":{"title":"Courses", "method": "/courses"},
            "5":{"title":"Subject", "method": "/subject"},
            "6":{"title":"Schedule", "method": "/schedule"},
            "7":{"title":"Evaluations", "method": "/evaluations"},
            "8":{"title":"Assigments", "method": "/assigments"},
            "9":{"title":"Grades", "method": "/grades"},
            "10":{"title":"Help", "method": "/help"}
          },
          "security": {
            "0":{"title":"Dashboard", "method": "/dashboard"},
            "1":{"title":"Users", "method": "/users"},
            "2":{"title":"Roles", "method": "/roles"},
            "3":{"title":"Access Rights", "method": "/accessrights"},
            "4":{"title":"Modules", "method": "/modules"},
            "5":{"title":"Transactions", "method": "/transactions"},
            "6":{"title": "Customers", "method": "/customers"},
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

  /*	methods:{

  		plans: function(){
  			window.location="http://localhost:8000/test";
  		},

  		programs: function(){
  			window.location="http://localhost:8000/";
  		},

  		courses: function(){
  			alert('courses');
  		},

  		subject: function(){
  			alert('subject');
  		},

  		teachers: function(){
  			alert('teachers');
  		},

  		help: function(){
  			alert('help');
  		},

  	}*/
    
  }
</script>