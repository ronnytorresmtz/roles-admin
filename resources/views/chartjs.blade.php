<!DOCTYPE html>
<html>
		
    <head>
      <title>ChartJs</title>
      

    <body>
      <div style="height:300;width:500;">
      	<canvas id="myChart" width="500" height="300"></canvas>
      </div>
      <div style="width:50%;">
        <canvas id="myChart2" width="300" height="200""></canvas>
      </div>


    </body>

		<script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/chartjs.bundle.min.js"></script>

		<script type="text/javascript">
			$( document ).ready(function() {

				var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)', //Blue
                        'rgba(255, 99, 132, 0.2)', //Red
                        'rgba(255, 206, 86, 0.2)', //Yellow
                        'rgba(75, 192, 192, 0.2)', //Green
                        'rgba(153, 102, 255, 0.2)', //Purple
                        'rgba(255, 159, 64, 0.2)'  //Orange
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive:true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById("myChart2");
        
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 99, 132, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                          // 'rgba(255,99,132,1)',
                          // 'rgba(255, 206, 86, 1)',
                          // 'rgba(75, 192, 192, 1)',
                          // 'rgba(153, 102, 255, 1)',
                          // 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
              responsive:false,
    maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
			});

		</script>
     

</html>
