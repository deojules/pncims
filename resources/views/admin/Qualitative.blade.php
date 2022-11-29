
@extends('layouts.app')


@section('content')


<section id="contact" class="contact">
    <div class="container " data-aos="fade-right">
        <div class="survey-title">
            <h2>Qualitative Data</h2>
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

        <div id="QualitativeData">
    
            @include('admin.QualitativeData')
            
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
            url: "{{ route('admin.qualitative.update') }}",
            type: 'POST',
            data: { _token:csrf, c_month:c_month,c_year:c_year},
            success: function (data) {

                $('#QualitativeData').html(data);

            },
            error: function () {
            
            },
        });
    });


});
</script>

    
@endsection