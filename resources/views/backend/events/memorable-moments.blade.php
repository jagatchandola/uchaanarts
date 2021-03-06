@extends('backend.layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/lightbox.min.css') }}">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Upload Memorable Moments</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            @php
                                $title = '';
                            @endphp
                            @if(count($uploadedMoments) > 0)
                            
                                @foreach($uploadedMoments as $moment)
                                    @if(empty($title))
                                        @php
                                            $title = $moment->title;
                                        @endphp
                                    @endif
                                    <div class="col-sm-2 text-center" id="moment-{{$moment->moment_id}}">
                                            <a href="{{ \App\Helpers\Helper::getImage($moment->eurl.'/slides/'.$moment->image, 3) }}" data-lightbox="{{$moment->moment_id}}" data-title="">
                                                <img src="{{ \App\Helpers\Helper::getImage($moment->eurl.'/slides/'.$moment->image, 3) }}" width="130" height="130"  style="padding:3px; border:1px solid #ccc;"/>                                                
                                            </a>
                                            <span style="position: absolute; right: 27px; top: 5px;" onclick="deleteImage('{{$moment->moment_id}}', '{{$moment->eurl}}', '{{$moment->image}}')">
                                                <i class="fa fa-close" style="padding: 5px; background: #fff;"></i>
                                            </span>
                                    </div>
                                @endforeach
                                
                            @endif
                            <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <form role="form" id="memorable-moments-form" name="memorable-moments-form" action="{{ route('upload-memorable-moments', $eventId) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group control-group after-add-more form-group">
                                                <div class="form-group">
                                                    <label>Event Title</label>
                                                    <input class="form-control" name="title" value="{{$title}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input class="form-control" type="file" name="image[]" required accept="image/*">
                                                </div>
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary add-more" style="font-size: 12px" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                                              </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        
                                        <div class="copy-fields hide">
                                            <div class="control-group input-group form-group">
                                                <div class="form-group">
                                                    <input class="form-control" type="file" name="image[]" required accept="image/*">
                                                </div>
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-danger remove" type="button" style="font-size: 12px"><i class="glyphicon glyphicon-remove"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

        </div>
        <script type="text/javascript" src="{{ asset('/js/lightbox-plus-jquery.min.js')}}"></script>

        <!-- /#wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
        $(".add-more").click(function(){ 
            var html = $(".copy-fields").html();
            $(".after-add-more").after(html);
        });
        
        //here it will remove the current value of the remove button which has been pressed
        $("body").on("click",".remove",function(){ 
            $(this).parents(".control-group").remove();
        });

        return false;
        $('#add-event-form').submit();        
    });
    
    function deleteImage(momentId, path, image) {
        var r = confirm('Are you sure, you want to Delete this image?');
        if (r == true) {
            $.ajax({
                type: "DELETE",
                url: "/admin/event/deleteMoment/"+momentId+'/'+path+'/'+image,
                success: function(data) {
                    if(data != 0 && data == true){
                        $("#moment-"+momentId).remove();
                        alert('Image deleted successfully');
                    } else {
                        alert('Something went wrong. Please try again!');
                        return false;
                    }
                },
                error: function(request,status,errorThrown) {
                   alert('request :'+request, 'status : '+status, 'errorThrown : '+errorThrown); 
                }
            });
        }
    }
</script>
@endsection