@extends('layouts.app')

@section('content')

               <section id="contact" class="contact">
                            <div class="container " data-aos="fade-right">
                                <div class="survey-title">
                                    <h2>Summary of CLients</h2>
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
                    </div>
                
            </section>
            
   <div id="ClientSummary">
    
         @include('admin.ClientSummaryData')
   </div>

   
      
   @endsection

   @section('script')

       

        

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

     <script>

      
            $('#c_month,#c_year').on('change',function () {
                let csrf = $('meta[name="csrf-token"]').attr('content');
                let c_month = $('#c_month').val();
                let c_year = $('#c_year').val();
                $.ajax({
                    url: "{{ route('admin.clients.update') }}",
                    type: 'POST',
                    data: { _token:csrf, c_month:c_month,c_year:c_year},
                    success: function (data) {

                        $('#ClientSummary').html(data);

                    },
                    error: function () {
                    
                    },
                });
            });

        
       
 </script>

 
    
@endsection