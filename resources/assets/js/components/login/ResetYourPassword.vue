<style scoped>
 a{
    cursor: pointer;
  }
  .confirm-password{
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
  <div class="panel panel-default component-center" v-if="showView">
    <div class="panel-heading">
      <h3 class="panel-title">Forgot Your Password </h3>
    </div>           
    <div class="panel-body">

      <form>
          <div class="row">
            <div class="col-sm-12 text-left">
              <p class="alert alert-info">
                Type the Security Code you received in your email account, then type your New Password, confirm the New Password and Click Send.
                
              </p>
              Security Number
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  <i class="glyphicon glyphicon-lock" ></i>
                </span>			
                <input 
                  v-model="securityNumber"
                  class="form-control"
                  type="" 
                  name="remember_security_number" 
                  value=""
                  size="10px"
                  aria-describedby="basic-addon1"
                  placeholder="Type the security number">
                </input>
              </div>
              
              <hr>
              New Password
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  <i class="glyphicon glyphicon-lock" ></i>
                </span>			
                <input 	
                    v-model="password"
                    type="password" 
                    name="new_password" 
                    class ="form-control",
                    maxlength="15",
                    placeholder="Type the new password">
                </input>
              </div>

              <span v-show="lengthMessage" class="confirm-password">Password require 8 characters</span>

              <br>
              Confirm Password
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  <i class="glyphicon glyphicon-lock" ></i>
                </span>			

                <input 	type="password"
                    v-model="confirmPassword"
                    name="new_password_confirmation" 
                    class ="form-control",
                    maxlength="15",
                    placeholder="Confirm the new password">
                </input>
              </div>
             
              <span v-show="confirmMessage" class="confirm-password">Confirm Password does not match</span>
              
            </div>
          </div>

          <hr>

          <div class="control-group" align="right" >
            <button 
              class="btn btn-sm btn-primary"
              style="width:100px"
              @click.prevent="resetPassword"
              :disabled="(confirmMessage) ? true : false"
            >
            Reset
            </button>
          </div>	
      </form>
    </div>
  </div>

</template>

<script>

  module.exports = {

    beforeCompile: function(){
      var self=this;
      self.$http.get('login/tokenExist', {token: self.$route.query.token}).then(function(response){
          if (response.data==true){
            self.showView = true;
            self.token = self.$route.query.token;
          }else{
            self.showView = false;
            self.$dispatch('displayAlert', 'danger', 'Not Authorized (401)');
          }
      }).catch(function (response) {
          self.showView = false;
          self.displayPopUpMessage(response);
      });

    },

    ready: function(){
    },

    data: function() {
      return {
        loading:false,
        securityNumber:'',
        password:'',
        token:'',
        confirmPassword:'',
        confirmMessage:'',
        lengthMessage:'',
        showView: false,
      }
    },


    methods: {

      resetPassword: function(){
        var self=this;
        self.loading = true;
        self.$http.post(
          'login/resetYourPassword', 
          {
            token: self.token,
            security_number: self.securityNumber, 
            new_password: self.password
          }
        ).then(function(response){
          if (!response.data.error){
            self.$route.router.go('/login');
          }else{
            self.loading = false;
            self.$dispatch('displayAlert',  'danger', response.data.message);
          }
        }).catch(function (response) {
          self.loading = false;
          self.displayPopUpMessage(response);
        });
      },

      displayPopUpMessage: function(response){
        this.$dispatch('displayAlert', (response.status==200) ? 'success' : 'danger', response.data + ' (' + response.status + ')');
      },
    },

     watch: {

      'password': function(){
          this.confirmMessage = (this.password == this.confirmPassword || !this.password) ? false : true;
          this.lengthMessage = (this.password.length >= 8 || !this.password) ? false : true;
      },

      'confirmPassword': function(){
          this.confirmMessage = (this.password == this.confirmPassword || !this.password)  ? false : true;
      },

     }

  }

</script>