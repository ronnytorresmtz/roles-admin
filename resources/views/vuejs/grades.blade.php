<!DOCTYPE html>
<html>
  <head>
    <meta id="token" name="token" value="{!!csrf_token()!!}">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
      {!! HTML::style('assets/css/bootstrap-theme.min.css') !!}
      {!! HTML::style('assets/css/grades.css') !!}
      
  </head>

  <body>
    <div class="container ">
      <div id='app'>
        <div id='content' class="row">
            <br>
            <grades></grades>
        </div>
      </div>
    </div>

    <template id="grades">
        <table class= "table table-striped table-bordered table-condensed table-hover"> 
        <theader>
          <tr>
          <th> Id </th> 
          <th> Nombre </th>
          <th> <input type="checkbox" name="check">Ene</input></th>
          <th> <input type="checkbox" name="check">Feb</input></th>
          <th> <input type="checkbox" name="check">Mar</input></th>
          <th> <input type="checkbox" name="check">Abr</input></th>
          <th> <input type="checkbox" name="check">May</input></th>
          <th> <input type="checkbox" name="check">Jun</input></th>
          <th> <input type="checkbox" name="check">Total</input></th>

          </tr>
        </theader>
        <tbody>
           <tr v-for="student in students">
            <td > @{{ student.id }} </td>
            <td > @{{ student.name }} </td>
            <td max-width="50px"> <input type="text" value="@{{ student.grade1 }}" >  </td>
            <td > @{{ student.grade2 }} </td>
            <td > @{{ student.grade3 }} </td>
            <td > @{{ student.grade4 }} </td>
            <td > @{{ student.grade5 }} </td>
            <td > @{{ student.grade6 }} </td>
            <td > @{{ student.total }} </td>

           <tr>
        </tbody>
        </table>  
    </template>

    {{--{!! HTML::script('http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.11/vue.min.js') !!}--}}
    {!! HTML::script('assets/js/vue.min.js') !!}
    {!! HTML::script('assets/js/vue-resource.min.js') !!}
    {!! HTML::script('assets/js/jquery-1.11.1.min.js') !!}
    {!! HTML::script('assets/js/bootstrap.min.js') !!}

    <script type="text/javascript">

      var myGrades = Vue.extend({

        template:  '#grades',

        data: function() {
            return {  
              students: students(),
            };
        },

        methods: {
          
          editGrades: function(e){
            
          },
        
          
        }
      });

      Vue.component('grades', myGrades);
      //create a root Vue instance 
      new Vue({
        el:'#app',
      });
     
     function students(){

      return [
                { id: 1, name: 'Student Student 1', grade1: 10, grade2: 9,grade3: 8,grade4: 10,grade5: 9,grade6: 10, total:100},
                { id: 2, name: 'Student Student 2', grade1: 10, grade2: 9,grade3: 8,grade4: 10,grade5: 9,grade6: 10, total:100},
                { id: 3, name: 'Student Student 3', grade1: 7, grade2: 7,grade3: 8,grade4: 9,grade5: 9,grade6: 10, total:100},
                { id: 4, name: 'Student Student 4', grade1: 10, grade2: 9,grade3: 8,grade4: 10,grade5: 9,grade6: 8, total:100},
                { id: 5, name: 'Student Student 5', grade1: 8, grade2: 9,grade3: 8,grade4: 10,grade5: 9,grade6: 10, total:100},
                { id: 6, name: 'Student Student 6', grade1: 10, grade2: 10,grade3: 8,grade4: 8,grade5: 9,grade6: 9, total:100},
                { id: 7, name: 'Student Student 7', grade1: 10, grade2: 9,grade3: 8,grade4: 8,grade5: 9,grade6: 8, total:100},
                { id: 8, name: 'Student Student 8', grade1: 10, grade2: 9,grade3: 8,grade4: 10,grade5: 9,grade6: 10, total:100},
                { id: 9, name: 'Student Student 9', grade1: 10, grade2: 9,grade3: 8,grade4: 10,grade5: 9,grade6: 10, total:100},
                { id: 10, name: 'Student Student 10', grade1: 10, grade2: 9,grade3: 8,grade4: 10,grade5: 9,grade6: 10, total:100},
            ]
     }

    </script>
  </body>
</html>