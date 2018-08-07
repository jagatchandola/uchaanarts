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
                                @include('layouts.alert')
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>View Arts</th>
                                                <th>Creative Artist<br>At Home Page</th>
                                                <th>Weekly Artist</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            {{-- */$i=0;/* --}}-->
                                            @php $i=1 @endphp
                                            @foreach($artists as $artist)
                                            <tr class="odd gradeX">
                                                <td>{{$i}}</td>
                                                <td>{{ $artist->uname }}</td>
                                                <td>{{ $artist->user_email }}</td>
                                                <!--<td class="center">{{ $artist->status == 1 ? 'Active' : 'Inactive' }}</td>-->
                                                <td class="text-center">
                                                    @if( $artist->status == 0)
                                                    <button type="button" class="btn btn-danger" onclick="changeStatus({{ $artist->id }}, 1, 'status')">Inactive</button>
                                                    @else
                                                        <button type="button" class="btn btn-success" onclick="changeStatus({{ $artist->id }}, 0, 'status')">Active</button>
                                                    @endif
                                                </td>
                                                <td class="text-center"><a href="{{ route('edit-artist', $artist->id) }}"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button></a></td>
                                                <td class="text-center"><a href="{{ route('view-artist-arts', $artist->id) }}"><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button></a></td>
                                                
                                                <td class="text-center">
                                                    @if( $artist->is_creative_artists == 0)
                                                        <button type="button" class="btn btn-danger" onclick="changeStatus({{ $artist->id }}, 1, 'creative_artist')"><i class="fa fa-close"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-success" onclick="changeStatus({{ $artist->id }}, 0, 'creative_artist')"><i class="fa fa-check"></i></button>
                                                    @endif
                                                </td>
                                                
                                                <td class="text-center">
                                                    @if( $artist->is_weekly_artist == 0)
                                                        <button type="button" class="btn btn-danger" onclick="changeStatus({{ $artist->id }}, 1, 'weekly_artist')"><i class="fa fa-close"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-success" onclick="changeStatus({{ $artist->id }}, 0, 'weekly_artist')"><i class="fa fa-check"></i></button>
                                                    @endif
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
            var updateStatus = status == 1 ? 'Active' : 'Inactive';
            var r = confirm("Are you sure, you want to change status?");
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