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
                            @include('layouts.alert')
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>venue</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Entry Fees</th>
                                                <th>Status</th>
                                                @can('isAdmin')
                                                <th>Edit</th>
                                                <th>Memorale Moments</th>
                                                @endcan
                                                @can('isArtist')
                                                <th>Participate</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            {{-- */$i=0;/* --}}-->
                                            @php $i=1 @endphp
                                            @foreach($events as $event)
                                            <tr class="odd gradeX">
                                                <td>{{$i}}</td>
                                                <td>{{ $event->etitle }}</td>
                                                <td>{{ $event->venue }}</td>
                                                <td class="text-center">{{ \App\Helpers\Helper::getFormattedDate($event->start_date) }}</td>
                                                <td class="text-center">{{ \App\Helpers\Helper::getFormattedDate($event->end_date) }}</td>
                                                <td class="text-right">{{ number_format($event->fees) }}</td>
                                                <td class="text-center">
                                                    @can('isAdmin')

                                                    @if( $event->status == 0)
                                                        <button type="button" class="btn btn-danger" onclick="changeStatus({{ $event->id }}, 1)">Inactive</button>
                                                    @else
                                                        <button type="button" class="btn btn-success" onclick="changeStatus({{ $event->id }}, 0)">Active</button>
                                                    @endif                                                
                                                    @endcan

                                                    @can('isArtist')
                                                        @if(strtotime($event->start_date) <= strtotime(date('Y-m-d')))
                                                            <button type="button" class="btn btn-danger">Inactive</button>
                                                        @elseif( $event->status == 0)
                                                            <button type="button" class="btn btn-danger">Inactive</button>
                                                        @else
                                                            <button type="button" class="btn btn-success">Upcoming</button>
                                                        @endif
                                                        
                                                    @endcan
                                                </td>
                                                
                                                <td class="text-center">
                                                @can('isAdmin')
                                                    <a href="{{ route('edit-event', $event->id) }}"Check $1><button type="button" class="btn btn-primary">Edit</button></a>
                                                @endcan

                                                @can('isArtist')
                                                    @if($event->start_date > date('Y-m-d'))
                                                        <a href="{{ route('participate-event', $event->id) }}"Check $1><button type="button" class="btn btn-primary">Participate</button></a>
                                                    @endif
                                                @endcan
                                                </td>
                                                @can('isAdmin')
                                                <td>
                                                @if(strtotime($event->start_date) <= strtotime(date('Y-m-d')))
                                                    <a href="{{ route('upload-memorable-moments', $event->id) }}"><button type="button" class="btn btn-success">Upload Moments</button></a>
                                                @endif
                                                </td>
                                                @endcan
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