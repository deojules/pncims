<script src="{{asset('assets/js/filter.js')}}"></script>

        <section id="contact" class="contact">
                    <div class="container " data-aos="fade-right">
                        <div class="survey-title">
                            <h2>Survey Log</h2>
                    </div>

                    <div id="homeData">
            
                        @include('admin.homeData')
                        
                    </div>
                
                <script>
                    window.onload = () => {
                        console.log(document.querySelector("#emp-table > tbody > tr:nth-child(1) > td:nth-child(2) ").innerHTML);
                    };

                    getUniqueValuesFromColumn()

                </script>

                    </div>
        </section>

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


       