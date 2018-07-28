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
                                @foreach($arts as $art)
                                <div class="dataTable_wrapper">
                                    
                                    <!--<img src="images/{{ $art->fname.'.'.$art->ext }}" />-->
                                    <a href="{{ route('edit-gallery', [$art->artist_id, $art->id]) }}" target="_blank">
                                        <img src="{{ \App\Helpers\Helper::getImage($art->fname . $art->ext, 0) }}" width="100" height="100" /><br/>
                                    </a>
                                    <span>{{ $art->title }}</span><br/>
                                    <span>By {{ $art->uname }}</span>
                                    
                                </div>
                                @endforeach
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="col-md-12 col-sm-12 clearfix">
          
          <div class="col-md-6 col-lg-6 col-sm-12 col-12 offset-md-3 offset-lg-3">
            <nav aria-label="Page navigation example align-center">
              {{$arts->links()}}
            </nav>
          </div>       
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