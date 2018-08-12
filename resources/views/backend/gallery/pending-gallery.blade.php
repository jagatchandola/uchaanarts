@extends('backend.layouts.app')

@section('content')

<div id="page-wrapper">   
    <div class="row">        
        <div class="col-lg-12">
            <div class="panel panel-default">                
                
                @if(!empty($message))
                <div class="alert alert-success fade in" id="success-div">
                    <a href="#" class="close">&times;</a>
                    <span>{{ $message }}</span>
                </div>
                @endif
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @if(empty($arts))
                    <div class="panel-heading">No record(s) found</div>
                    @else
                    @foreach($arts as $art)
                    <div class="dataTable_wrapper">
                        <a href="{{ route('update-pending-gallery', [$art->id]) }}">
                            <img src="{{ \App\Helpers\Helper::getImage($art->username .'/imgs/'.$art->fname .'.'. $art->ext, 1) }}" width="100" height="100" /><br/>
                        </a>
                        <span>{{ $art->title }}</span><br/>
                        <span>By {{ $art->uname }}</span>

                    </div>
                    @endforeach
                    @endif
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="col-md-12 col-sm-12 clearfix">

    </div>
</div>
<!-- /#wrapper -->
@endsection
