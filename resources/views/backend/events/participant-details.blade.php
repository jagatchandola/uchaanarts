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

                    <form role="form" name="participant-details-form" action="{{ route('participant', [$event_id, $artist_id]) }}" method="post">
                            @foreach($eventArts as $art)
                                <div class="dataTable_wrapper">
                                    <img src="{{ \App\Helpers\Helper::getImage($art->username.'/imgs/'.$art->fname .'.'. $art->ext, 1) }}" width="100" height="100" /><br/>
                                    <span>{{ $art->title }}</span><br/>
                                    <span>Rs. {{ $art->totalPrice }}</span>
                                    <input type="checkbox" name="event_id[]" value="{{ $art->id }}" />
                                    <input type="radio" name="featured_image" id="active" value="{{ $art->id }}">
                                </div>
                            @endforeach
                            
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-md-12 col-sm-12 clearfix"></div>

<!-- /#wrapper -->
@endsection
