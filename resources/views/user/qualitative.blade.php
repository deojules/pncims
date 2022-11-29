@extends('layouts.app')


@section('content')


<section id="contact" class="contact">
    <div class="container " data-aos="fade-right">
        <div class="survey-title">
            <h2>{{$department->name}}</h2>
       </div>
         
        <div id="change-content" class="row">
                            
                <div class="col-sm-2">
                    <label>Month</label>
                    <select class="form-select" name="month" id="c_month">
                        @for($i = 1;$i < 13 ; $i++)
                        <option value="{{sprintf('%02d',$i)}}" @if(date('n')== $i) selected @endif>{{date('F',strtotime('1970-'.$i))}}</option>
                        @endfor 
                    </select>
                </div>
                
                <div class="col-sm-2">
                    <label>Year</label>
                    <select class="form-select" name="year" id="c_year">
                        @foreach ($years as $year )
                        <option value={{$year->year}} @if(date('Y')==$year->year) selected @endif>{{$year->year}}</option>
                            
                        @endforeach
                    </select>
                </div>

        </div>  

        <div id="qualitativeData">
    
            @include('user.qualitativeData')
            
        </div>

       
    </div>

</section>

@endsection

@section('script')


<script>

$(document).ready(function () {

    $('#c_month,#c_year').on('change',function () {
        let csrf = $('meta[name="csrf-token"]').attr('content');
        let c_month = $('#c_month').val();
        let c_year = $('#c_year').val();
        $.ajax({
            url: "{{route('update_dept_quali',[$department->acronym]) }}",
            type: 'POST',
            data: { _token:csrf, c_month:c_month,c_year:c_year},
            success: function (data) {

                $('#qualitativeData').html(data);

            },
            error: function () {
            
            },
        });
    });


});
</script>

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

    <!--Delivery-->
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

  <!--Delivery -->
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
                    label: 'Quality of work',
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


@endsection