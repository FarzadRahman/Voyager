@extends('voyager::master')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="myTable">
                <thead>
                <th>Customer</th>
                <th>Total</th>
                <th>status</th>
                <th>Created At</th>
                <th>Action</th>
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
                        // d.date=$('#date1').val();
                        // d.clientId=$('#clientId').val();
                        // d.statusId=$('#statusId').val();
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
                            return 'hii'  ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            } );
        });
    </script>

@endsection
