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
                                                <th>Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            {{-- */$i=0;/* --}}-->
                                            @php $i=1 @endphp
                                            @foreach($events as $event)
                                            <tr class="odd gradeX">
                                                <td>{{$i}}</td>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ $event->start_date }}</td>
                                                <td>{{ $event->end_date }}</td>
                                                <td class="center">{{ $event->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td class="center">View</td>
                                                <td class="center">Edit</td>
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
    </script>
@endsection