@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
            <div class="clearfix">
                <h1 class="page-header">Pending Products</h1>
            </div>
                <div class="row">                    
                    <div class="col-lg-12">                        
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                @include('layouts.alert')
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Approve</th>
                                                <th class="text-center">View Arts</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            {{-- */$i=0;/* --}}-->
                                            @php $i=1 @endphp
                                            @foreach($artists as $artist)
                                            <tr class="odd gradeX">
                                                <td class="text-center">{{$i}}</td>
                                                <td class="text-center">{{ $artist->uname }}</td>
                                                <td class="text-center">{{ $artist->user_email }}</td>
                                                <td class="text-center">                                                    
                                                        <button type="button" class="btn btn-success" onclick="changeStatus({{ $artist->id }}, 1, 'approve')">Yes</button>
                                                </td>                                                
                                                <td class="text-center">
                                                    <a href="{{ route('view-artist-arts', $artist->id) }}">
                                                        <button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                                    </a>
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
                responsive: true,
                "lengthMenu": [20,30,40,50]
            });
        });
        
        function changeStatus(id, status, type) {
            var r = confirm("Are you sure, you want to approve this artist?");
            if (r == true) {
                $.ajax({
                    method: "PUT",
                    url: "/admin/artists/changeStatus/"+id,
                    data: {
                            status:status, type:type
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
    </script>
@endsection