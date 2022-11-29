
@extends('layouts.app')


@section('content')


<section id="contact" class="contact">
    <div class="container " data-aos="fade-right">
        <div class="survey-title">
            <h2>Overall Ratings</h2>
      </div>
        <div id="change-content" class="row">

            <div class="col-sm-4">
                <label>Department</label>
                <select class="form-select" name="dept" id="c_dept">
                    <option value="0" selected>All Department</option>
                    @foreach($departments as $dept)
                    <option value="{{$dept->dept_id}}">{{$dept->name}}</option>
                    @endforeach
                </select>
            </div>

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

        <div id="OverAllData">

            @include('admin.OverAllData')

        </div>

    </div>


@endsection

@section('script')


  <script>

        $(document).ready(function () {
                $('#c_month,#c_year,#c_dept').on('change',function () {
                    let csrf = $('meta[name="csrf-token"]').attr('content');
                    let c_month = $('#c_month').val();
                    let c_year = $('#c_year').val();
                    let c_dept = $('#c_dept').val();
                    $.ajax({
                        url: "{{ route('admin.overall.update') }}",
                        type: 'POST',
                        data: { _token:csrf, c_month:c_month,c_year:c_year,c_dept:c_dept},
                        success: function (data) {

                            $('#OverAllData').html(data);

                        },
                        error: function () {

                        },
                    });
                });


                });

</script>

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
                            data: graph_qStaff,
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

@endsection
