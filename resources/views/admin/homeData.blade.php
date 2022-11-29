

<table id="emp-table" class="table table-hover" style="width:100%" >
    <thead>
        <tr class="table-success">
            <th>Id</th>
            <th>Staff </th>

       <th  col-index = 3 >Department
        <select class="table-filter" onchange="filter_rows()">
            <option value="all">All</option>
            @foreach($departments as $dept)
            <option value="{{$dept->acronym}}">{{$dept->acronym}}</option>
            @endforeach
        </select>
       </th>

            <th col-index = 4>Category/Type
                <select class="table-filter" onchange="filter_rows()">
                    <option value="all">All</option>
                </select>
            </th>
            <th>Client Name</th>
            <th>Service </th>
            <th>Date</th>
            <th>Rating</th>
        </tr>
    </thead>
    <tbody>
        @foreach($responses as $response)
        <tr >
            <td>{{$loop->index+1}}</td>
            <td>{{$response->info->fname.' '.$response->info->lname}}</td>
            <td>{{$response->department->acronym}}</td>

            @if($response->type == 1)
            <td>Guest/Parent/Guardian</td>
            @elseif($response->type == 2)
            <td>Guest/Administrator</td>
            @elseif($response->type == 3)
            <td>Guest/Alumni</td>
            @elseif($response->type == 4)
            <td>Others</td>
            @elseif($response->category == 1 )
            <td>Employee</td>
            @elseif($response->category == 2)
            <td>Student</td>
            @endif
            <td>{{$response->name}}</td>
            <td>{{$response->service}}</td>
            <td>{{$response->date}}</td>
            <td>{{$response->rating}}</td>
        </tr>
       @endforeach
    </tbody>


</table>
