


     <section id="contact" class="contact">
        <div class="container-sm" data-aos="fade-right">
            <div class="survey-title">
                <h2>By Department</h2>
           </div>


                @foreach($departments as $dept)

                <table class="table table-hover">
                    <tr>
                        <th colspan=2 style="width: 50%">{{$dept->name}}</th>

                    </tr>
                    @foreach($dept->emp_depts as $ed)
                        @if($dept->comment->where('staff',$ed->p_id)->isNotEmpty())
                    <tr>

                        <td style="width:30%" class="fs-6">
                            {{$ed->user->fullname}}
                        </td>
                        <td style="width:70%">
                            <ol>
                                @foreach ($dept->comment->where('staff',$ed->p_id) as $response )
                                     <li>
                                        {{$response->comment}}
                                     </li>
                                @endforeach
                            </ol>
                        </td>

                    </tr>
                        @endif
                    @endforeach
                        @if($dept->comment->isEmpty())

                                <tr>
                                    <td class="text-center" colspan=2><i>No survey responses yet</i></td>
                                </tr>
                        @endif
                </table>
                @endforeach
        </div>
     </section>

