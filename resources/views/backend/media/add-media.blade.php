@extends('backend.layouts.app')

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Media Coverage</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" name="add-media-form" action="{{ route('add-media') }}" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Image:</label>
                                           
                                                <input class="form-control" type="file" name="image" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" name="title" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Status</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="active" value="1" checked>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="inactive" value="0">Inactive
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
