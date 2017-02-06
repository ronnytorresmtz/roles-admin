<style scoped>

.selectwidth{
  width:80px;
}
  
</style>

<template>

  <div class="panel panel-default"> 
    <div class="panel-heading">
      <h3 class="panel-title">{{title}}</h3>
    </div> 
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-1" v-if="showYear">
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
      <div class="row" style="padding-left:10px;padding-right:20px">
        <br>
        <div :width="width" :height="height">
          <canvas :id="id" :width="width" :height="height"></canvas>
        </div>

      </div>

      <div class="row">
          <span style="color:blue; padding:20px" align="left" v-if='loading'>
           <img src="/assets/icons/loading_image.gif"/>  Loading 
          </span>
          
        </div>
    </div>
  </div>

<!-- <pre> {{$data | json}} </pre> -->

</template>

myChart
<script>

module.exports = {

    props: [
      'id',
      'width',
      'height',
      'type', 
      'url', 
      'title', 
      'color', 
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
        id: this.id,
        title: this.title,
        years:'',
        months:'',
        labels:'',
        label:'',
        series:'',
        yearSelected:'', 
        monthSelected:'',
        loading: false
      }
    },

    methods:{

      initYearandMonth: function(){

        var date = new Date();
        this.yearSelected = date.getFullYear();
        this.monthSelected = date.getMonth() + 1;

      },


      changeYearMonth: function(){

        this.displayGraph(this.yearSelected, this.monthSelected);

      },

      displayGraph: function(year, month){
        var self=this;
        self.loading = true;

        self.$http.post(self.url, {"year": year, "month": month}).then((responde) => {

          console.log(responde);

          self.years = responde.data.years;
          self.months = responde.data.months;
          self.labels = responde.data.labels;
          self.label = responde.data.legend;
          self.series = responde.data.series;

        }).then(function (responde) {

          var chartData = {
            type: self.type,
            data: self.setData(self.labels, self.label, self.series),
            options: self.setOptions(self.series),
            width: 'width:' + self.width //width in porcentage (ex. 50%)
          }
          
          var canvas = document.getElementById(self.id);
          var myChart = new Chart(canvas, chartData); 

          timeout(function() {
            myChart.destroy();
          }, 200);

          self.loading = false;

        }).catch(function (responde) {
          self.loading = false;
          alert(responde.status);
        });
      },

      setData: function(labels, label, series){

          return {
            labels: labels,
            datasets: [
              {
                // type: 'line',
                fill: true,
                label: label,
                data: series,
                backgroundColor: this.getbackgroundColors(this.color, opaque=0.2),  //'rgba(54, 162, 235, 0.2)', 
                borderColor: this.borderColor(this.color, opaque=1),      //'rgba(54, 162, 235, 1)',
                borderWidth: 1
              },
              // {
              //   type: 'line',
              //   label: ['Expense'],
              //   data: [20, 50, 8, 20, 4, 5],
              //   backgroundColor: this.getbackgroundColors(this.color, opaque=0.2),  //'rgba(54, 162, 235, 0.2)', 
              //   borderColor: this.borderColor(this.color, opaque=1),      //'rgba(54, 162, 235, 1)',
              //   borderWidth: 1
              // },
            ]
           }
      },

      setOptions: function(series){

        var maxValue = Math.max(...series);

        return {
          responsive: true,
          maintainAspectRatio: false,
          exportEnabled: true,
          legend:{
            display: (this.legendDisplay=='false') ? false : true,
            position: this.legendPosition,
            labels:{
              boxWidth: 20,
            }
          },
          scales: {
              yAxes: [{
                scaleLabel: {
                  display: true,
                  labelString: this.yTitle
                },
                ticks: {
                  beginAtZero: true,
                  min: 0,
                  max: maxValue
                }
              }],
              xAxes: [{
                scaleLabel: {
                  display: true,
                  labelString: this.xTitle
                },
              }]
            }

        }
      },

      getbackgroundColors: function(color, opaque){

        var backgroundColors = this.getColors(opaque);

        for (var key in backgroundColors) {
           if (key==color){
             return backgroundColors[key];
           }
        }
      },

      borderColor: function(color){

        var borderColor = this.getColors(opaque);

        for (var key in borderColor) {
           if (key==color){
             return borderColor[key];
           }
        }
      },

      getColors: function(opaque){
        return {
          'red': 'rgba(255, 99, 132,' + opaque + ')',
          'blue': 'rgba(54, 162, 235,' + opaque + ')',
          'yellow':'rgba(255, 206, 86,' + opaque + ')',
          'green': 'rgba(75, 192, 192,' + opaque + ')',
          'purple': 'rgba(153, 102, 255,' + opaque + ')',
          'orange': 'rgba(255, 159, 64,' + opaque + ')'
        }
      },
      
    }
  }

</script>