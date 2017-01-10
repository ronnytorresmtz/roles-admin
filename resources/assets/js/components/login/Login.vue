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
      margin: auto;
  }
 
</style>

<template>
<div>
    <slot name="message"></slot>
    <br><br><br><br><br><br><br>
    <div class="panel panel-default" class="component-center"> 
      <div class="panel-heading">
        <h3 class="panel-title">Sign In
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
										placeholder="Type the user name"
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
										placeholder="Type the password">
									</input>
									
								</div>
						</div>
					</div>

					<br>
					
          <div class="row">
            <div class="col-sm-6 text-left">
              <div class="control-group" >
                <input type="checkbox"></input>
                Remember Me
              </div>	
            </div>	
											
            <div class="col-sm-6 text-right">
              <div class="control-group"  >
                <a @click="showEmailToSend">
                Forgot your Password 
                </a>	
              </div>
            </div>	
          </div>
          
          <hr>


          <div v-show="forgotYourPassword">
            <div class="row">
              <div class="col-sm-12 text-left">

                  <div class="alert alert-info">
                    <p><strong>Get Your Password</strong></p>
                    Enter the email address associated with your account, then click Send. You will recieve an email with instrucctions to set a new password.'
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
                      placeholder="Type an email address"
                      value="">
                    </input>
                  </div>
                  <span v-show="emailErrMessage" class="error-email">Please type a valid email address</span>
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
                              Send
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
                 Login User Demo 
                </button>
              </div>

              <div class="col-sm-6" align="right">
                 <button 
                  class="btn btn-sm btn-primary"  
                  style="width: 100px"
                  :disabled="(username && password) ? false : true"
                  @click="btnLogin"
                 >
                  Sign in 
                 </button>
              </div>			
            </div>	
        </div>	
				
      </div>       
    </div> 
  </div>

</template>

<script>

  module.exports = {

    ready: function(){
    // this.isUserAuthenticated();
    },

    data: function() {
      return {
        username:'',
        password:'',
        email:'',
        loading:false,
        forgotYourPassword:false,
        emailErrMessage:true,
      }
    },


    methods: {

      // isUserAuthenticated: function(){
      //   this.$http.get('login/userAuthenticated').then(function(response){
      //     console.log(response.status);
      //   }).then(function (response) {
      //     if (response.status!=200){
      //       this.$route.router.go('/login');
      //      }
      //   });
      //   }).catch(function (response) {
      //     this.displayPopUpMessage(response);
      //   });
      // },



      showEmailToSend: function(){
        this.forgotYourPassword = !this.forgotYourPassword;
      },

      btnLogin: function(){
        this.checkLogIn(this.username, this.password, '/dashboard');
      },

      btnLoginDemo: function(){
        this.checkLogIn("demo_user","demo123", '/dashboard');
      },

      btnSendEmail: function(){
        if (this.isValidEmail(this.email)){
          this.loading = true;
          this.$http.post('login/sendYourPassword', {email: this.email}).then(function(response){
            this.displayPopUpMessage(response);
          }).then(function (response) {
              this.loading = false;
              this.forgotYourPassword = false;
          }).catch(function (response) {
            this.displayPopUpMessage(response);
            this.loading = false;
          });
        }

      },

      checkLogIn: function(username, password, url){
        this.loading= true;
        this.$http.post('login/logIn', {username: username, password: password}).then(function(response){
            if (response.status==200){
                this.$route.router.go(url);
            }else{
              this.displayPopUpMessage(response);
            }
        }).then(function (response) {
            this.loading= false;
        }).catch(function (response) {
          this.displayPopUpMessage(response);
          this.loading= false;
        }).bind(this);

      },

      displayPopUpMessage: function(response){
        this.$dispatch('displayAlert', (response.status==200) ? 'success' : 'danger', response.data + ' (' + response.status + ')');
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