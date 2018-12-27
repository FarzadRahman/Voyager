@extends('voyager::master')
@section('content')
    <br>
<div class="card">
    <div class="card-header">
        <div class="row container">
            <div class="col-md-6">
                <label>Status</label>
                <select class="form-control" id="status" onchange="orderStatus(this)">
                    <option value="">Select Status</option>
                    <option value="PENDING">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="delivered">Delivered</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="myTable">
            <thead>
                <th style="text-align:center">Customer</th>
                <th style="text-align:center">Total</th>
                <th style="text-align:center">status</th>
                <th style="text-align:center">Created At</th>
                <th style="text-align:center">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>





@endsection

@section('javascript')

<script>


    $(document).ready( function() {
      // alert('Jquery is running');
      //   $('#myTable').DataTable();
        dataTable=  $('#myTable').DataTable({
            rowReorder: {
                selector: 'td:nth-child(0)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            Filter: true,
            stateSave: true,
            ordering:false,
            type:"POST",
            "ajax":{
                "url": "{!! route('order.getData') !!}",
                "type": "POST",
                data:function (d){
                    d._token="{{csrf_token()}}";
                    d.status=$('#status').val();
                },
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'total', name: 'total' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { "data": function(data){
                        {{--var url='{{url("product/edit/", ":id") }}';--}}
                        //     return '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="editjob(this)"><i class="fa fa-edit"></i></a>'+
                        //     '<a class="btn btn-default btn-sm" data-panel-id="'+data.jobId+'" onclick="commentjob(this)"><i class="fa fa-comments"></i></a>'
                          return '<a class="btn btn-sm btn-warning pull-right view" href="#">view</a>'+
                              '&nbsp;<a class="btn btn-sm btn-primary pull-right edit" href="#">edit</a>';},
                    "orderable": false, "searchable":false, "name":"selected_rows" },
            ]
        } );
    });

    function orderStatus(x){
        var  value=$(x).val();
        dataTable.ajax.reload();

    }
</script>

@endsection
