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
        <div id='content' class="row">
            <calendarday></calendarday>
        </div>
        <template id="calendar-day">
            <div class="day-border">
               <div > 
                  <span class="dayofMonth">@{{dayOfMonth}} </span>
                  <div class="events" v-for="event in events" style="background: @{{event.color}}">
                     <i class="glyphicon glyphicon-calendar" @click="showEvent"></i>
                     <span >@{{event.subject}}</span>
                     <input type="hidden" name="eventid" value="@{{event.id}}">
                  </div>
               <div>
            </div> 

            <div class="modal" id="modal_id" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" style="background:@{{currentColor}}; color:white">
                    <h4 class="modal-title"> Appoinment - @{{currentEventSubject}} </h4>
                  </div>
                  <div class="modal-body">

                    <form style="padding-top:10px" role="form">
                      <input type="hidden" v-model="currentEventId"> </input>
                      <div class="row">
                        <div class="col-sm-12 text-left">
                            {!! Form::label('Subject')!!}
                            <input name="subject" class="form-control" size="10px" v-model="currentEventSubject" type="text" max-width="auto" > </input>
                        </div>
                      </div>
                    </form>
                    <form style="padding-top:10px" role="form">
                      <div class="row">
                        <div class="col-sm-6 text-left">
                            {!! Form::label('Start Date')!!}
                            <input name="currentStartDate" class="form-control" size="10px" v-model="currentStartDate" type="date" max-width="auto" > </input>
                        </div>

                        <div class="col-sm-6 text-left">
                            {!! Form::label('Start Time')!!}
                            <input name="currentStartTime" class="form-control" size="10px" v-model="currentStartTime" type="time" > </input>
                        </div>
                      </div>
                    </form>
                    <form style="padding-top:10px" role="form">
                      <div class="row">
                         <div class="col-sm-6 text-left">
                            {!! Form::label('End Date')!!}
                            <input name="currentEndDate" class="form-control" size="10px" v-model="currentEndDate" type="date" > </input>
                        </div>
                        
                        <div class="col-sm-6 text-left">
                            {!! Form::label('End Time')!!}
                            <input name="currentEndTime" class="form-control" size="10px" v-model="currentEndTime" type="time" > </input>
                        </div>

                      </div>
                    </form>
                    <form style="padding-top:10px" role="form">
                      <div class="row">
                        <div class="col-sm-12 text-left">
                            {!! Form::label('Location')!!}
                            <input name="currentLocation" class="form-control" size="10px" v-model="currentLocation" type="text" max-width="auto" > </input>
                        </div>
                      </div>
                    </form>
                    <form style="padding-top:10px" role="form">
                      <div class="row">
                        <div class="col-sm-6 text-left">
                            {!! Form::label('Category')!!}
                            {!! Form::select('category', ['Normal', 'High priority', 'Low priority'],'', array('class' => 'form-control'))!!}
                        </div>
                        <div class="col-sm-6 text-left">
                            {!! Form::label('Show As')!!}
                            {!! Form::select('ShowAs', ['Tentative', 'Busy', 'Normal', 'Free'],'', array('class' => 'form-control'))!!}
                        </div>
                      </div>
                    </form>
                    <form style="padding-top:10px" role="form">
                      <div class="row">
                        <div class="col-sm-12 text-left">
                            {!! Form::label('Detail')!!}
                            <textarea name="currentNotes" class="form-control" size="50px" v-model="currentNotes" row="7" > </textarea>
                        </div>
                      </div>
                    </form>
                    <form style="padding-top:10px" role="form">
                      <div class="row">
                        <div class="col-sm-6 text-left">
                          <input type="checkbox"> All day </input>
                        </div> 
                        <div class="col-sm-6 text-right">
                          <a href="#"> Recurrence </a>
                        </div>
                      </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" @click="closeModal" >Close</button>
                      <button type="button" class="btn btn-default" @click="saveEvent">Save changes</button>
                    </div>
                </div>
              </div>
              </div>
        </template>

    {{--{!! HTML::script('http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.11/vue.min.js') !!}--}}
    {!! HTML::script('assets/js/vue.min.js') !!}
    {!! HTML::script('assets/js/vue-resource.min.js') !!}
    {!! HTML::script('assets/js/jquery-1.11.1.min.js') !!}
    {!! HTML::script('assets/js/bootstrap.min.js') !!}

    <script type="text/javascript">

      var MyCalendarDay = Vue.extend({

        template:  '#calendar-day',

        data: function() {
            return {  
              dayOfMonth: 1,
              events: eventarray(),
              currentEventSubject:'',
              currentEventId: null,
              currentColor:''

            };
        },

        methods: {
          
          showEvent: function(e){
            //get the event subject
            this.currentEventSubject=e.target.nextElementSibling.innerText;
            //get the event id store in a input with a hidden field
            this.currentEventId=e.target.nextElementSibling.nextElementSibling.value;
            //get the event color
            this.currentColor=e.target.parentNode.style.backgroundColor;
            //show a modal window
            $('#modal_id').show();
          },
        
          closeModal: function(e){
             $('#modal_id').hide();
          },

          saveEvent: function(e){
            console.log (this.currentEventId);
            for (var i=0; i<this.events.length; i++) {
              if (this.events[i].id == this.currentEventId) {
                this.events[i].subject = this.currentEventSubject;
                break;
              }
            }
            $('#modal_id').hide();
          },
        }
      });

      Vue.component('calendarday', MyCalendarDay);
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