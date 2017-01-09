<style scoped>

.selectwidth{
    position: relative;
    min-width:80px;
    margin-right: 5px;
}
  
</style>

<template>

  <div class="panel panel-default"> 
    <div class="panel-heading">
      <h3 class="panel-title">
      {{title}}
      <span style="color:blue;" align="left" v-if='loading'>
        <img src="/assets/icons/loading_image.gif"/>
      </span>
      </h3>
    </div> 
    <div class="panel-body">
      <div class="row">
          <div v-if="showYear">
            <div class="col-xs-1 selectwidth " v-if="showYear">
              Year: 
              <select name="year" class="form-control selectwidth" v-model="yearSelected" @change="changeYearMonth()">
                <option v-for="(key, value) in years" value="{{value}}"> {{value}} </option>
              </select>
            </div>
            <div class="col-xs-1" v-if="showMonth" >
              Month: 
              <select name="month" class="form-control selectwidth" v-model="monthSelected" @change="changeYearMonth()">
                <option v-for="(key, value) in months" value="{{key + 1}}"> {{value}} </option>
              </select>
            </div>
          </div>
      </div>
      <div class="row" style="padding-left:10px;padding-right:20px">
        <br>
        <div :id="id" style="height:250px" ></div>
      </div>
    </div>
  </div>

<!-- <pre> {{$data | json}} </pre> -->

</template>

myChart
<script>

import MyLang from '../../components/languages/Languages.vue';

module.exports = {

    mixins: [MyLang],

    props: [
      'id',
      'width',
      'height',
      'type', 
      'url', 
      'title', 
      'legendPosition', 
      'legendDisplay',
      'xTitle',
      'yTitle',
      'showYear',
      'showMonth'
    ],

    ready: function(){
      this.initYearandMonth();
      this.displayGraph(this.yearSelected, this.monthSelected);
      this.showYear = (this.showYear == 'false') ? false : true;
      this.showMonth = (this.showMonth == 'false') ? false : true;
    },

    data: function(){
      return {
        years:'',
        months:'',
        labels:'',
        label:'',
        series:'',
        years:[],
        months: [],
        yearSelected:'', 
        monthSelected:'',
        loading: false,
        chart:''
      }
    },

    methods:{

      initYearandMonth: function(){
        var date = new Date();
        var currentYear = date.getFullYear();

        for (var i = currentYear; i >= currentYear - 5; i--) { 
          this.years.push(i);
        }

        this.months = this.ts['short_months'];
        this.yearSelected = currentYear;
        this.monthSelected = date.getMonth() + 1;

      },

      changeYearMonth: function(){
        this.displayGraph(this.yearSelected, this.monthSelected);
      },

      displayGraph: function(year, month){
        this.loading = true;
        this.$http.post(this.url, {"year": year, "month": month}).then((responde) => {
          this.labels = responde.data.labels;
          this.label = responde.data.legend;
          this.series = responde.data.series;
        }).then(function (responde) {
          $('#' + this.id).highcharts(this.setOptions(this.series));
          this.loading = false;
        }).catch(function (responde) {
          this.displayPopUpMessage(response);
          this.loading = false;
        });
      },

      displayPopUpMessage: function(response){
        this.$dispatch('displayAlert', (response.status==200) ? 'success' : 'danger', response.data.message + ' (' + response.status + ')');
      },


      setOptions: function(series){
        var maxValue = Math.max(...series);
        return {

          chart: {
            height:this.height,
            type: this.type
          },
          credits:false,
          title:{
            text: null
          },
          xAxis: {
              categories: this.labels,
              title: {
                  text: this.xTitle
              }
          },
          yAxis: {
              min: 0,
              max: maxValue,
              allowDecimals: false,
              title: {
                  text: this.label
              }
          },
          legend:{
            enabled: (this.legendDisplay == 'false') ? false : true,
            verticalAlign: this.legendPosition
          },
          exporting:{
            enabled: false
          },
          series: [{
              name: this.yTitle,
              data: this.series,
          }],
        }
      },
    }
  }

</script>