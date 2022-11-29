


     <section id="contact" class="contact">


        <div class="container-sm" data-aos="fade-right">
            <h2 class="mt-5">Overall Ratings on Delivery</h2>
            <div class="container " data-aos="fade-right">
              <canvas id="delivery" height="100px"></canvas>
           </div>


           <h2 class="mt-5">Overall Ratings on Communications</h2>
           <div class="container " data-aos="fade-right">
             <canvas id="communications" height="100px"></canvas>
          </div>


          <h2 class="mt-5">Overall Ratings on Quality of staff</h2>
          <div class="container" data-aos="fade-right">
            <canvas id="qStaff" height="100px"></canvas>
         </div>

         <h2 class="mt-5">Overall Ratings on Quality of work</h2>
         <div class="container" data-aos="fade-right">
           <canvas id="qWork" height="100px"></canvas>
        </div>

        <h2 class="mt-5">Overall Ratings on Problem Solving</h2>
        <div class="container" data-aos="fade-right">
          <canvas id="pSolving" height="100px"></canvas>
       </div>

       @if(!$req_dept_id)
            <div class="container-sm" data-aos="fade-right">

                <div class="survey-title mt-5">
                    <h2>By Division</h2>
              </div>



                    <table class="table table-hover">
                        <tr>
                            <th style="font-size:13px;">Division</th>
                            <th style="font-size:13px;">Delivery</th>
                            <th style="font-size:13px;">Commnucations</th>
                            <th style="font-size:13px;">Quality of Staff</th>
                            <th style="font-size:13px;">Quality of Work</th>
                            <th style="font-size:13px;">Problem Solving</th>

                        </tr>
                        @foreach($division as $key => $div)
                        <tr>
                            <td>{{$div}}</td>
                            <td>{{$div_delivery[$key]}}</td>
                            <td>{{$div_communication[$key]}}</td>
                            <td>{{$div_qStaff[$key]}}</td>
                            <td>{{$div_qWork[$key]}}</td>
                            <td>{{$div_pSolving[$key]}}</td>
                        </tr>
                        @endforeach
                    </table>


           <div class="survey-title mt-5" >
            <h2>By Departments</h2>
          </div>
                    <div class="table-responsive-xl">
                            <table class="table table-hover">
                                <tr>
                                    <th style="font-size:13px;">Department</th>
                                    <th style="font-size:13px;">Delivery</th>
                                    <th style="font-size:13px;">Commnucations</th>
                                    <th style="font-size:13px;">Quality of Staff</th>
                                    <th style="font-size:13px;">Quality of Work</th>
                                    <th style="font-size:13px;">Problem Solving</th>

                                </tr>
                                @foreach($departments as $dept)

                                <tr>
                                    <td style="font-size:16px;">{{$dept->name}}</td>
                                    <td >
                                        @if($dept->delivery)
                                        {{number_format($dept->delivery,2,'.',',')}}
                                        @endif
                                    </td>
                                    <td >
                                        @if($dept->communications)
                                        {{number_format($dept->communications,2,'.',',')}}
                                        @endif
                                    </td>
                                    <td >
                                        @if($dept->qStaff)
                                        {{number_format($dept->qStaff,2,'.',',')}}
                                        @endif
                                    </td>
                                    <td >
                                        @if($dept->qWork)
                                        {{number_format($dept->qWork,2,'.',',')}}
                                        @endif
                                    </td>
                                    <td >
                                        @if($dept->pSolving)
                                        {{number_format($dept->pSolving,2,'.',',')}}
                                        @endif
                                    </td>

                                </tr>

                                @endforeach
                            </table>
                    </div>
                    @endif
        </div>
     </section>

<!--Delivery -->
 <script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var graph_delivery =  @json($graph_delivery);

                const data = {
                labels: labels,
                datasets: [{
                    label: 'Delivery',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: graph_delivery,
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


<!--communications -->
<script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var graph_communications =  @json($graph_communications);

                const data = {
                labels: labels,
                datasets: [{
                    label: 'Communications',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: graph_communications,
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

<!--qStaff -->
<script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var graph_qStaff =  @json($graph_qStaff);

                const data = {
                labels: labels,
                datasets: [{
                    label: 'Quality of staff',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data:
graph_qStaff,
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
<!--qWork-->
<script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var graph_qWork =  @json($graph_qWork);

                const data = {
                labels: labels,
                datasets: [{
                    label: 'Quality of work',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: graph_qWork,
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


<!--pSolving-->
<script type="text/javascript">

    $(document).ready(function () {

             var labels = @json($labels);
            var graph_pSolving =  @json($graph_pSolving);

                const data = {
                labels: labels,
                datasets: [{
                    label: 'Problem Solving',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: graph_pSolving,
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
