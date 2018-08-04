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
                                                <th></th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Url</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            {{-- */$i=0;/* --}}-->
                                            @php $i=1 @endphp
                                            @foreach($banners as $banner)
                                            <tr class="odd gradeX">
                                                <td>{{$i}}</td>
                                                <td><img src="{{ \App\Helpers\Helper::getImage($banner->image, 6) }}" width="60" height="40px"></td>
                                                <td>{{ $banner->title }}</td>
                                                <td>{{ $banner->description }}</td>
                                                <td>{{ $banner->url }}</td>
                                                <!--<td class="center">{{ $banner->status == 1 ? 'Active' : 'Inactive' }}</td>-->
                                                <td class="center">
                                                    @if( $banner->status == 0)
                                                    <button type="button" class="btn btn-danger" onclick="changeStatus({{ $banner->id }}, 1)">Inactive</button>
                                                    @else
                                                        <button type="button" class="btn btn-success" onclick="changeStatus({{ $banner->id }}, 0)">Active</button>
                                                    @endif
                                                </td>
                                                <td class="center"><a href="{{ route('edit-banner', $banner->id) }}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                                                
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
        
        function changeStatus(id, status) {
            var updateStatus = status == 1 ? 'Active' : 'Inactive';
            var r = confirm("Are you sure, you want to change status to " + updateStatus + "?");
            if (r == true) {
                $.ajax({
                    method: "PUT",
                    url: "/admin/banner/changeStatus/"+id,
                    data: {
                            status:status
                         },
                    dataType: "json",
                    success: function(response) {
                        if (response == 1) {
//                            alert('Status updated successfully!');
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