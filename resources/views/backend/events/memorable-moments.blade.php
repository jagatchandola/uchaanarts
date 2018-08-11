@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
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
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" id="memorable-moments-form" name="memorable-moments-form" action="{{ route('upload-memorable-moments', $eventId) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group control-group after-add-more form-group">
                                                <div class="form-group">
                                                    <label>Event Title</label>
                                                    <input class="form-control" name="event_name" value="" required>
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
                                                <div class="col-xs-3" style="padding-left: 0">
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
        $(".add-more").click(function(){ 
            var html = $(".copy-fields").html();
            $(".after-add-more").after(html);
        });
        
        //here it will remove the current value of the remove button which has been pressed
        $("body").on("click",".remove",function(){ 
            $(this).parents(".control-group").remove();
        });

        if($('#start_date').val() > $('#end_date').val()) {
            alert('Start date can not b greater than end date!');
            return false;
        }
        return false;
        $('#add-event-form').submit();
    });
</script>
@endsection