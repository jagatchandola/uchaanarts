@extends('backend.layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Participants</h1>
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
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <form role="form" name="participant-details-form" action="{{ route('participant', [$event_id, $artist_id]) }}" method="post">
                            @foreach($eventArts as $art)
                            <div class="col-md-2" style="border: 1px solid #ccc; padding: 10px">
                                <div class="dataTable_wrapper text-center">
                                    <img src="{{ \App\Helpers\Helper::getImage($art->username.'/imgs/'.$art->fname .'.'. $art->ext, 1) }}" width="130" height="130" /><br/>
                                    <div class="text-left">
                                    <div>{{ $art->title }}</div>
                                    <div>Rs. {{ $art->totalPrice }}</div>
                                    <div>
                                    <input type="checkbox" name="event_id[]" id="item-{{$art->id}}" value="{{ $art->id }}" /> <label for="item-{{$art->id}}">Approve Image</label></div>
                                    <div><input type="radio" name="featured_image" id="featured-{{$art->id}}" value="{{ $art->id }}"> <label for="featured-{{$art->id}}">Feature Image</label></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        <div class="col-md-12 text-center" style="margin-top: 10px">    
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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
