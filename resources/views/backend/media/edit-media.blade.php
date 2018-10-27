@extends('backend.layouts.app')

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Media Coverage</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" name="edit-media-form" action="{{ route('edit-media-post') }}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="media-id" value="{{ $media->id }}" />

                                            <div class="form-group">
                                                <label>Image: <img src="{{ \App\Helpers\Helper::getImage($media->image, 7) }}" width="200" height="100"></label>
                                           
                                                <input class="form-control" type="file" name="image" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" name="title" value="{{ $media->title }}" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Status</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="active" value="1" @if($media->status == 1) checked @endif>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="inactive" value="0" @if($media->status == 0) checked @endif>Inactive
                                                </label>                                                
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
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
@endsection
