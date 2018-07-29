@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Event Title</th>
                                                <th>Artist Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @php $i=1 @endphp
                                            @foreach($eventParticipants as $event)
                                            <tr class="odd gradeX">
                                                <td>{{$i}}</td>
                                                <td>{{ $event->etitle }}</td>
                                                <td>{{ $event->uname }}</td>
                                                
                                                <td class="text-center">
                                                    <a href="{{ route('participant', [$event->event_id, $event->artist_id]) }}" target="_blank"><button type="button" class="btn btn-primary">View Arts</button></a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

        </div>
        <!-- /#wrapper -->
@endsection

@section('script')
<script src="{{ asset('backend/js/dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables').DataTable({
                responsive: true
            });
        });
        
        @can('isAdmin')
            function changeStatus(id, status) {
                var updateStatus = status == 1 ? 'Active' : 'Inactive';
                var r = confirm("Are you sure, you want to change status to " + updateStatus + "?");
                if (r == true) {
                    $.ajax({
                        method: "PUT",
                        url: "/admin/events/changeStatus/"+id,
                        data: {
                                status:status
                             },
                        dataType: "json",
                        success: function(response) {
                            if (response == 1) {
                                setTimeout(function() {
                                    location.reload(true);    
                                }, 500);
                            } else {
                                alert('Something went wrong. Please try again!');
                                return false;
                            }                        
                        },
                        error: function(request,status,errorThrown) {
                           alert('request :'+request,'status : '+status,'errorThrown : '+errorThrown); 
                        }
                    });
                }
            }
        @endcan
    </script>
@endsection