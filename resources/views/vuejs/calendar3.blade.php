<!DOCTYPE html>
<html>
  <head>

    <meta id="token" name="token" value="{!!csrf_token()!!}">
      
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
      {!! HTML::style('assets/css/bootstrap-theme.min.css') !!}
      {!! HTML::style('assets/css/calendar.css') !!}

  </head>

  <body>

    <div class="container ">
  
      <div id='app'>
        <div id='header' class="row">

            <maintitle></maintitle>

        </div>
        <div id='content' class="row">

            <calendar></calendar>

            <br>

            <calendarday></calendarday>
            <calendarday></calendarday>

        </div>

        <div id='footer' class="row">

            <createdBy company="TMTechnologies (2015-2016)"></createdBy>
              
        </div>

        <div class="modal" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Edit Event</h4>
                </div>
                <div class="modal-body">
                  
                  {!! Form::label('Subject')!!}
                  {!! Form::text('Subject')!!}
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
      </div> 

    
    <template id="title">
          <h1> @{{title}} <h1>  
    </template>

    <template id="calendar">

     <table class= "table table-bordered table-condensed "> 
     <tr>
        <td v-for="day in monthDays">
         
              @{{ day + 1}}
         
        </td>
     <tr>


      </table>


    </template>


    <template id="calendar-day">

      
        <div class="day-border">

           <div > 
              <span class="dayofMonth">@{{dayOfMonth}} </span>
              <div class="events" v-for="event in events" 
              style="background: @{{event.color}}" v-on:click="updateEvent" data-toggle="modal" data-target="#myModal">
                 <span >  @{{event.subject}}</span>
              </div>
           <div>

        </div> 


    </template>
        
    <template id="createdby-company">

      <br>

      <div>
        <span class="createdby"> Created by @{{company}} </span> 
        <span id="data" class="glyphicon glyphicon-cog" aria-hidden="true" @click="showData" style="cursor: pointer"> </span>
      </div>

      <br>
        
      <div id='debug-data-info' class="row" v-show="viewData">
        <pre style ="background:graylight"> @{{ $data | json }} </pre>
      </div>

    </template>

    {{--{!! HTML::script('http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.11/vue.min.js') !!}--}}
    {!! HTML::script('assets/js/vue.js') !!}
    {!! HTML::script('assets/js/vue-resource.min.js') !!}
    {!! HTML::script('assets/js/jquery-1.11.1.min.js') !!}
    {!! HTML::script('assets/js/bootstrap.min.js') !!}

    <script type="text/javascript">
      //define component
      var MyCreatedBy = Vue.extend({

        props: { company: { type: String,  required: true } },

        template:  '#createdby-company',

         data: function() {
              return {  
                viewData: false,
              };
          },

        methods: {
          showData: function(){
  
              this.viewData= !this.viewData;
          }
        }

      });

      var MyCalendarDay = Vue.extend({

        template:  '#calendar-day',

         data: function() {
              return {  
                dayOfMonth: 1,
                classname: 'calendar-day',
                events: eventarray(),
                modal: false,
              };
          },

        methods: {
          addEvent: function(e){
  
                alert('addEvent');
          },

          updateEvent: function(e){

             // alert(e.target.innerText);
          },

          deleteEvent: function(e){
  
              alert('deleteEvent');
          },

        

        }

      });


      var MyCalendar = Vue.extend({

        template:  '#calendar',

        data: function() {
              return {  
                monthDays: this.daysInMonth()
              }
        },

        methods: {
          daysInMonth: function () {

            var arrWeeks = [];

            var arrWeek = [];


            var objDate = new Date();

            var days = new Date(objDate.getMonth(), objDate.getFullYear(), 0).getDate()+1;

            var firstDayDate = new Date(objDate.getFullYear(), objDate.getMonth(), 1);

            var lastDayDate = new Date(objDate.getFullYear(), objDate.getMonth(), days);

            var firstWeekDay=firstDayDate.getDay() + 1;

            var j = 0;
            for (var i = 1 ; i <= days; i++) {

              arrWeek[i] = i ;

                            
            };

            

            console.log (arrWeek)

            return days;
          }
        },

      });


      var MyMainTitle = Vue.extend({

        template:  '#title',

        data: function() {
              return {  
                title: 'Calendar VueJS Recharge',
              };
          },

      });

    //tag name and register component
      Vue.component('createdby', MyCreatedBy);
      Vue.component('calendarday', MyCalendarDay);
      Vue.component('calendar', MyCalendar);
      Vue.component('maintitle', MyMainTitle);

      //create a root Vue instance 
     new Vue({

        el:'#app',

      });
     


     function eventarray(){

      return [
                    {
                      id: 1,
                      subject: 'Revisión de Tareas de Construcción',
                      start_time: '09:00 am',
                      finish_time: '10:00 am',
                      location: 'Mty Office',
                      all_day_event: false,
                      notes: "Visitar al Cliente",
                      color: 'blue'
                    },
                    {
                      id: 2,
                      subject: 'Determinar Plan de Trabajo',
                      start_time: '12:00 am',
                      finish_time: '13:00 am',
                      location: 'Mty Office',
                      all_day_event: false,
                      notes: "Visitar al Cliente 2",
                      color: 'green'
                    },

                    {
                      id: 3,
                      subject: 'Modificar Diseño IV4',
                      start_time: '12:00 am',
                      finish_time: '13:00 am',
                      location: 'Mty Office',
                      all_day_event: false,
                      notes: "Visitar al Cliente 2",
                      color: 'purple'
                    }
                ]


     }

    </script>

  </body>

</html>