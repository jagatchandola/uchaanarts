@extends('backend.layouts.app')

@section('content')

            <div id="page-wrapper">
                @if(!empty($message))
                    <div class="alert alert-success fade in" id="success-div">
                        <a href="#" class="close">&times;</a>
                        <span>{{ $message }}</span>
                    </div>
                @endif
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
