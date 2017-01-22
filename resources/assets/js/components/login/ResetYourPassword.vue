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
      this.$http.get('login/tokenExist', {token: this.$route.query.token}).then(function(response){
          if (response.data==true){
            this.showView = true;
            this.token = this.$route.query.token;
          }else{
            this.showView = false;
            this.$dispatch('displayAlert', 'danger', 'Not Authorized (401)');
          }
      }).catch(function (response) {
          this.showView = false;
          this.displayPopUpMessage(response);
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
        this.loading = true;
        this.$http.post(
          'login/resetYourPassword', 
          {
            token: this.token,
            security_number: this.securityNumber, 
            new_password: this.password
          }
        ).then(function(response){
          if (!response.data.error){
            this.$route.router.go('/login');
          }else{
            this.loading = false;
            this.$dispatch('displayAlert',  'danger', response.data.message);
          }
        }).catch(function (response) {
          this.loading = false;
          this.displayPopUpMessage(response);
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