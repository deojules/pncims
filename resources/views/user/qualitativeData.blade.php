
   
    
   
     <section id="contact" class="contact">
        <div class="container-sm" data-aos="fade-right">
        

           <h2>Average Rating</h2>
           <div class="container " data-aos="fade-right">
             <canvas id="averageRating" height="100px"></canvas>
          </div>

          
          <h2 class="mt-5">Overall Ratings on Delivery</h2>
          <div class="container " data-aos="fade-right">
            <canvas id="delivery" height="100px"></canvas>
         </div>

         <h2 class="mt-5">Overall Ratings on Communicaitons</h2>
         <div class="container " data-aos="fade-right">
           <canvas id="communications" height="100px"></canvas>
        </div>

        
        <h2 class="mt-5">Overall Ratings on Quality of staff</h2>
        <div class="container " data-aos="fade-right">
          <canvas id="qStaff" height="100px"></canvas>
       </div>

       <h2 class="mt-5">Overall Ratings on Quality of work</h2>
       <div class="container " data-aos="fade-right">
         <canvas id="qWork" height="100px"></canvas>
      </div>

      <h2 class="mt-5">Overall Ratings on Problem Solving</h2>
      <div class="container " data-aos="fade-right">
        <canvas id="pSolving" height="100px"></canvas>
     </div>



           <h2 class="mt-5">Comments</h2>
           <ol>
                @foreach($responses as $response)
                  <li>{{$response->comment}}</li>
                @endforeach
          </ol>

     

        </div>
     </section>


     

     <script type="text/javascript">

        $(document).ready(function () {

            
                var labels = @json($labels);
                var clients =  @json($clients);
            
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Average Ratings',
                        backgroundColor: 'rgb(54, 162, 235)',
                        borderColor: 'rgb(54, 162, 235)',
                        data: clients,
                    }]
                };
            
                const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                    title: {
                        display: true,

                    }
                    },
                    scales: {
                    yAxes: {
                        
                        min: 1,
                        max: 5,
                        ticks: {
                                precision: 0
                            }
                    }
                    
                    }
                },
             };
            
                const myChart = new Chart(
                    document.getElementById('averageRating'),
                    config
                );

            });

</script>


    <!--Delivery -->    
<script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var delivery =  @json($delivery);
        
                const data = {
                labels: labels,
                datasets: [{
                    label: 'Delivery',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: delivery,
                }]
            };
        
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                    title: {
                        display: true,

                    }
                    },
                    scales: {
                    yAxes: {
                        
                        min: 1,
                        max: 5,
               
                    }
                    
                    }
                },
             };
        
            const myChart = new Chart(
                document.getElementById('delivery'),
                config
            );

        });


</script>

  <!--Communications -->
  <script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var communications =  @json($communications);
        
                const data = {
                labels: labels,
                datasets: [{
                    label: 'communications',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: communications,
                }]
            };
        
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                    title: {
                        display: true,

                    }
                    },
                    scales: {
                    yAxes: {
                        
                        min: 1,
                        max: 5,
               
                    }
                    
                    }
                },
             };
        
            const myChart = new Chart(
                document.getElementById('communications'),
                config
            );

        });

</script>

 <!--Quality of qStaff -->
 <script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var qStaff =  @json($qStaff);
        
                const data = {
                labels: labels,
                datasets: [{
                    label: 'Quality of staff',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: qStaff,
                }]
            };
        
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                    title: {
                        display: true,

                    }
                    },
                    scales: {
                    yAxes: {
                        
                        min: 1,
                        max: 5,
               
                    }
                    
                    }
                },
             };
        
            const myChart = new Chart(
                document.getElementById('qStaff'),
                config
            );

        });

</script>

<!--Quality of qWork -->
<script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var qWork =  @json($qWork);
        
                const data = {
                labels: labels,
                datasets: [{
                    label: 'Quality of staff',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: qWork,
                }]
            };
        
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                    title: {
                        display: true,

                    }
                    },
                    scales: {
                    yAxes: {
                        
                        min: 1,
                        max: 5,
               
                    }
                    
                    }
                },
             };
        
            const myChart = new Chart(
                document.getElementById('qWork'),
                config
            );

        });

</script>
<!--pSolving -->
<script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var pSolving =  @json($pSolving);
        
                const data = {
                labels: labels,
                datasets: [{
                    label: 'Problem Solving',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: pSolving,
                }]
            };
        
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                    title: {
                        display: true,

                    }
                    },
                    scales: {
                    yAxes: {
                        
                        min: 1,
                        max: 5,
               
                    }
                    
                    }
                },
             };
        
            const myChart = new Chart(
                document.getElementById('pSolving'),
                config
            );

        });

</script>
