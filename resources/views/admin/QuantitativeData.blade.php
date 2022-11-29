

            <section id="contact" class="contact">
            <div class="container " data-aos="fade-right">
                <canvas id="myChart" height="100px"></canvas>
            </div>
        </section>


        <section id="contact" class="contact">
            <div class="container-sm" data-aos="fade-right">

                <div class="survey-title">
                    <h2>By Division</h2>
               </div>

                    <table class="table table-hover">
                        <tr>
                            <th>Division</th>
                            <th>Average Rating</th>
                        </tr>

                        @foreach($division as $key => $div)
                        @php


                        $average = $division_responses[$key];

                        @endphp
                        <tr>
                            <td>{{$div}}</td>
                            <td>
                                @if($average)
                                {{number_format($average,2,'.',',')}}
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </table>
            </div>
        </section>

     <section id="contact" class="contact">
        <div class="container-sm" data-aos="fade-right">
            <div class="survey-title">
                <h2>By Department</h2>
           </div>
                <table class="table table-hover">
                    <tr>
                        <th>Department</th>
                        <th>Average Rating</th>
                    </tr>

                    @foreach($departments as $dept)
                    @php

                        $average = $responses->whereIn('dept_id', $dept->dept_id)
                        ->pluck('rating')->avg();



                    @endphp
                    <tr>
                        <td>{{$dept->name}}</td>
                        <td>
                            @if($average)
                            {{number_format($average,2,'.',',')}}
                            @endif
                        </td>

                    </tr>
                    @endforeach

                </table>
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
                    document.getElementById('myChart'),
                    config
                );

            });



</script>


