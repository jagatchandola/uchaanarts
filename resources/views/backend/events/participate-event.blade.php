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
                    @if (empty($arts))
                        <div class="dataTable_wrapper">No record(s) found</div>
                    @else
                        <form role="form" name="edit-gallery-form" action="{{ route('edit-gallery-post') }}" method="post" enctype="multipart/form-data">
                            @foreach($arts as $art)
                            <div class="dataTable_wrapper">

                                <a href="{{ route('edit-gallery', [$art->artist_id, $art->id]) }}" target="_blank">
                                    <img src="{{ \App\Helpers\Helper::getImage($art->fname . $art->ext, 0) }}" width="100" height="100" /><br/>
                                </a>
                                <span>{{ $art->title }}</span><br/>
                                <input type="checkbox" name="art_id[]" value="{{ $art->id }}" @if(in_array($art->id, $eventArts)) checked="checked" @endif />
                            </div>
                            @endforeach
                            
                            <button type="submit" class="btn btn-default">Participate</button>
                        </form>
                    @endif
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
