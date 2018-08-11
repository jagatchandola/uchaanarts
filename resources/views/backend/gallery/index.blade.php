@extends('backend.layouts.app')

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Products</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                @if(!empty($message))
                    <div class="alert alert-success fade in" id="success-div">
                        <a href="#" class="close">&times;</a>
                        <span>{{ $message }}</span>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
<!--                             <div class="panel-heading">Products</div>
 -->                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                @foreach($arts as $art)
                                <div class="dataTable_wrapper col-md-3">
                                    @if($art->isSold == 0)
                                        <a href="{{ route('edit-gallery', [$art->artist_id, $art->id]) }}">
                                            <img src="{{ \App\Helpers\Helper::getImage($art->username .'/imgs/'. $art->fname .'.'. $art->ext, 1) }}" width="200" height="200" title="{{ $art->uname }}" /><br/>
                                        </a>
                                        <span>{{ mb_strimwidth($art->title, 0, 25, '...') }}</span><br/>
                                        <span><b>By:</b> {{ $art->uname }}</span>
                                    @else 
                                            <img src="{{ \App\Helpers\Helper::getImage($art->username .'/imgs/'. $art->fname .'.'. $art->ext, 1) }}" width="200" height="200" title="{{ $art->uname }}" /><br/>
                                        <span>{{ mb_strimwidth($art->title, 0, 25, '...') }}</span><br/>
                                        <span><b>By:</b> {{ $art->uname }}</span>
                                    @endif
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
