

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
                            <th>Number of Clients</th>
                        </tr>
                        @foreach($division as $key => $div)
                        <tr>
                            <td>{{$div}}</td>
                            <td>{{$division_responses[$key]}}</td>
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
                        <th>Number of Clients</th>
                    </tr>
                    @foreach($departments as $dept)
                    <tr>
                        <td>{{$dept->name}}</td>
                        <td>{{$responses->where('dept_id', $dept->dept_id)->count()}}</td>
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
                            label: 'Number of Clients',
                            backgroundColor: 'rgb(54, 162, 235)',
                            borderColor: 'rgb(54, 162, 235)',
                            data: clients,
                        }]
                    };
                
                    const config = {
                        type: 'line',
                        data: data,
                        options: {}
                    };
                
                    const myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );

                });

    

    </script>

   



 


