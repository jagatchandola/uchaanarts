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
                                @if(!empty($quries))
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">Customer</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">mobile</th>
                                                <th class="text-center">Query</th>
                                                <th class="text-center">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            {{-- */$i=0;/* --}}-->
                                           
                                            @foreach($quries as $query)
                                            <tr class="odd gradeX">
                                                <td class="text-center"><img src="{{ \App\Helpers\Helper::getImage($query->directory.'/imgs/'.$query->fname.'.'.$query->ext, 1) }}" width="60" height="40px"><br>
                                                <small>{{ $query->uname }}</small></td>
                                                <td>{{ $query->name }}</td>
                                                <td>{{ $query->email }}</td>
                                                <td class="text-center">{{ $query->mobile_no }}</td>
                                                <td>{{ $query->comments }}</td>
                                                <td class="text-center">{{ date('d-M-Y', strtotime($query->date_enquiry)) }}</td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                @endif
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
        
    </script>
@endsection