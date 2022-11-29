
  <button type="button" class="btn btn-success mt-5 mb-5 service-1" data-bs-toggle="modal" data-bs-target="#serviceModal" id="closemodal">
    Add Service
  </button>


<table class="table table-hover service-2" style="width:100%" >
    <thead>
        <tr class="table-success">
            <th>#</th>

            <th>Description</th>
            <th class="text-center" style="width:15%">Action</th>
        </tr>
    </thead>
    <tbody id="emp-table-body">
        @foreach($dept_service as $value)
        <tr>

            <td>{{$loop->index+1}}</td>

            <td>{{$value->services}}</td>
            <td class="text-center">
                <button class="btn btn-danger delete" data-id='{{$value->service_id}}'>Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>










