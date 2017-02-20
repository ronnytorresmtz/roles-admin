<style scoped>
 a{
    cursor: pointer;
  }
  .error-email{
    color:red;
    font-size: 12px;
    font-style:italic;
  }
  .component-center{
      display: block;
       margin-top: 50px;
  }
 
</style>

<template>
<div>
    <slot name="message"></slot>
    <div class="panel panel-default component-center"> 
      <div class="panel-heading">
        <h3 class="panel-title">{{ ts['signIn'] }}
          <span style="color:blue; padding-top:10px; padding-right:20px" align="left" v-if='loading'>
              <img src="/assets/icons/loading_image.gif"/>   
            </span>
        </h3>
      </div>  
      <div class="panel-body body-height"> 
        <div class="row">
						<div class="col-sm-12 text-left">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">
										<i class="glyphicon glyphicon-user" ></i>
									</span>			
									<input 
                    type="text" 
                    v-model="username"
                    name="username" 
                    id="username" 
                    class ="form-control",
										placeholder="{{ ts['typeTheUsername'] }}"
										value="">
									</input>
								</div>
								<br>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 text-left">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">
										<i class="glyphicon glyphicon-lock" ></i>
									</span>	

									<input 
                    type="password" 
                    v-model="password"
                    name="password" 
                    id="password" 
                    class ="form-control",
										placeholder="{{ ts['typeThePassword'] }}">
									</input>
									
								</div>
						</div>
					</div>

					<br>
					
          <div class="row">
            <div class="col-sm-6 text-left">
              <div class="control-group" >
                <input type="checkbox" v-model="rememberMe"></input>
                {{ ts['rememberMe'] }}
              </div>	
            </div>	
											
            <div class="col-sm-6 text-right">
              <div class="control-group"  >
                <a @click="showEmailToSend">
                {{ ts['forgotYourPassword'] }}
                </a>	
              </div>
            </div>	
          </div>
          
          <hr>


          <div v-show="forgotYourPassword">
            <div class="row">
              <div class="col-sm-12 text-left">

                  <div class="alert alert-info">
                    <p><strong>{{ ts['getYourPassword'] }}</strong></p>
                    {{ ts['getYourPassMsg'] }}
							    </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                      <i class="glyphicon glyphicon-envelope" ></i>
                    </span>			
                    <input 
                      type="email" 
                      v-model="email"
                      name="email" 
                      id="email" 
                      class ="form-control",
                      placeholder="{{ ts['typeTheEmailAddress'] }}"
                      value="">
                    </input>
                  </div>
                  <span v-show="emailErrMessage" class="error-email">{{ ts['typeTheEmailError'] }}</span>
                  <hr>

                    <div class="control-group" >
                        <div class="row">
                          <div class="col-sm-6" ></div>
                          <div class="col-sm-6" align="right">
                            <button 
                              class="btn btn-sm btn-primary"  
                              style="width: 100px"
                              :disabled="(email) ? false : true"
                              @click="btnSendEmail"
                            >
                             {{ ts['send'] }} 
                            </button>
                          </div>			
                        </div>	
                    </div>	

              </div>
            </div>
          </div>
          
          <div class="control-group" v-show="!forgotYourPassword">
            <div class="row">
              <div class="col-sm-6" align="left">
                <button 
                  class="btn btn-sm btn-success"
                  @click="btnLoginDemo"
                > 
                 {{ ts['loginUserDemo'] }} 
                </button>
              </div>

              <div class="col-sm-6" align="right">
                 <button 
                  class="btn btn-sm btn-primary"  
                  style="width: 100px"
                  :disabled="(username && password) ? false : true"
                  @click="btnLogin"
                 >
                  {{ ts['signIn'] }}
                 </button>
              </div>			
            </div>	
        </div>	
				
      </div>       
    </div> 
  </div>

</template>

<script>

 import MyLang from '../../components/languages/Languages.vue';

  module.exports = {

   mixins: [MyLang],

    ready: function(){
      this.username=localStorage.getItem("rememberUserName");
      this.rememberMe=(this.username) ? true : false;
    },

    data: function() {
      return {
        username:'',
        password:'',
        email:'',
        loading:false,
        forgotYourPassword:false,
        emailErrMessage:true,
        rememberMe:false,
      }
    },


    methods: {

      rememberMe: function(){
        if (typeof(Storage) !== "undefined") {
         localStorage.setItem("rememberUserName",  this.rememberMe ?  this.username : '');
        } else {
          this.$dispatch('displayAlert', 'danger', 'This funcionality is not support for your browser');
        }
      },

      showEmailToSend: function(){
        this.forgotYourPassword = !this.forgotYourPassword;
      },

      btnLogin: function(){
        this.checkLogIn(this.username, this.password, '/dashboard');
      },

      btnLoginDemo: function(){
        this.username = "demo_user";
        this.password = "demo123"
        this.checkLogIn(this.username, this.password, '/dashboard');
      },

      btnSendEmail: function(){
        var self=this;
        if (self.isValidEmail(self.email)){
          self.loading = true;
          self.$http.post('login/sendYourPassword', {email: self.email}).then(function(response){
            self.displayPopUpMessage(response);
          }).then(function (response) {
              self.loading = false;
              self.forgotYourPassword = false;
          }).catch(function (response) {
            self.displayPopUpMessage(response);
            self.loading = false;
          });
        }

      },

      checkLogIn: function(username, password, url){
        var self = this;
        var rememberMe = this.rememberMe;
        var username =  this.username;
        self.loading= true;
        self.$http.post('login/logIn', {username: username, password: password}).then(function(response){
            if (response.status==200){
                localStorage.setItem("rememberUserName",  rememberMe ?  username : '');
                self.$route.router.go(url);
            }else{
              self.displayPopUpMessage(response);
            }
        }).then(function (response) {
            self.loading= false;
        }).catch(function (response) {
          self.displayPopUpMessage(response);
          self.loading= false;
        });//.bind(this);

      },

      displayPopUpMessage: function(response){
        try{
          this.$dispatc('displayAlert', (!response.data.error) ? 'success' : 'danger', response.data.message + ' (' + response.status + ')');
        }catch(error){
          this.$dispatch('displayAlert', 'danger', error.name + ' Exception: ' + error.message);
        }
      },


     isValidEmail: function(email){
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return emailReg.test( email );
      }
      
    },

     watch: {

      'username': function (){
        this.forgotYourPassword=false;
      },

      'password': function (){
        this.forgotYourPassword=false;
      },

      'email': function(){
          this.emailErrMessage = (this.email) ? !this.isValidEmail(this.email) : true;
      },

     }

  }

</script>