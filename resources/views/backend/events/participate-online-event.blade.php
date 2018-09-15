@extends('backend.layouts.app')

@section('content')

<div id="page-wrapper">
    <div class="clearfix">
        <h1 class="page-header">Products</h1>
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
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @if (empty($arts))
                        <div class="dataTable_wrapper">No record(s) found</div>
                    @else
                        <form role="form" name="particiapte-event-form" action="{{ route('participate-online-event', $event_id) }}" method="post">
                            <input type="hidden" name="event_art_id" value="{{ $event_artist_id }}" />
                            @foreach($arts as $art)
                            <div class="col-sm-3">
                               <img src="{{ \App\Helpers\Helper::getImage($art->username .'/imgs/'. $art->fname .'.'. $art->ext, 1) }}" width="100" height="100" /><br/>
                                <span>{{ $art->title }}</span><br/>
                                <input type="checkbox" name="art_id[]" value="{{ $art->id }}" @if(in_array($art->id, $eventArts)) checked="checked" @endif />
                            </div>
                            @endforeach
                            
                            <button type="submit" class="btn btn-primary">Participate</button>
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

<script type="text/javascript">
$(document).ready(function(){
    $("form").submit(function() {
        if($('input[type=checkbox]:checked').length == 0)
        {
            alert ( "ERROR! Please select at least one art" );
            return false;
        }
        
        var r = confirm("Are you sure you want to submit?");
        if (r == true) {
            return true;
        }
        return false;
    });
});
</script>
@endsection
