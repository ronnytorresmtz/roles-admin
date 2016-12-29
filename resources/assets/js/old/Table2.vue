<style >
  .header {
    font-weight: bold;
  }
</style>



<template>
  
    <div class="container-fluid">

      <div class="row">
        <slot name="mybuttons" ></slot>
      </div>

      <br/>

      <div class="row">

        <div class="col-sm-9">
        
            <div class="row">
              <table class= "table table-striped table-bordered table-condensed table-hover">  
                <th  class="header" v-for="col in cols"> 
                    {{col}} 
                </th>
                <tbody>
                  <tr v-for="row in rows">
                    <td> {{row.programId}}</td>
                    <td> {{row.programName}}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="row">
              <div align="right">
                <a class="btn btn-sm btn-primary button-size" @click.prevent="startPage"> Start </a>
                <a class="btn btn-sm btn-primary button-size" @click.prevent="previousPage"> Prev </a>
                <a class="btn btn-sm btn-primary button-size" @click.prevent="nextPage"> Next </a>
                <a class="btn btn-sm btn-primary button-size" @click.prevent="endPage"> End </a>
              <div> 
            </div>
        
        </div>

        <div class="col-sm-3">
        
          <slot name="myforms" v-if="visible"></slot>
        
        </div>
      </div>
    </div>

    

</template>


<script>

  module.exports = {

    data: function() {
      return {

        visible: true,
        cols: ['Program ID','Program Name'],
        rows:[]        
      }
    },



    methods:{
      startPage: function(){
        this.rows=[
            {'programId': 'MA-I', 'programName': 'Matematicas I'},
            {'programId': 'MA-II', 'programName': 'Matematicas II'},
            {'programId': 'MA-III', 'programName': 'Matematicas III'},
            {'programId': 'MA-IV', 'programName': 'Matematicas IV'},
            {'programId': 'MA-V', 'programName': 'Matematicas V'}
          ]
      },
      previousPage: function(){
          this.rows=[
            {'programId': 'MA-I2', 'programName': 'Matematicas I2'},
            {'programId': 'MA-II2', 'programName': 'Matematicas II2'},
            {'programId': 'MA-III2', 'programName': 'Matematicas III2'},
            {'programId': 'MA-IV2', 'programName': 'Matematicas IV2'},
            {'programId': 'MA-V2', 'programName': 'Matematicas V2'}
          ]

      },
      nextPage: function(){
          this.rows=[
            {'programId': 'MA-I2', 'programName': 'Matematicas I2'},
            {'programId': 'MA-II2', 'programName': 'Matematicas II2'},
            {'programId': 'MA-III2', 'programName': 'Matematicas III2'},
            {'programId': 'MA-IV2', 'programName': 'Matematicas IV2'},
            {'programId': 'MA-V2', 'programName': 'Matematicas V2'}
          ]
      },
      endPage: function(){
          this.rows=[
            {'programId': 'MA-I3', 'programName': 'Matematicas I3'},
            {'programId': 'MA-II3', 'programName': 'Matematicas II3'},
            {'programId': 'MA-III3', 'programName': 'Matematicas III3'},
            {'programId': 'MA-IV3', 'programName': 'Matematicas IV3'},
            {'programId': 'MA-V3', 'programName': 'Matematicas V3'}
          ]

      },

    },

  }
</script>