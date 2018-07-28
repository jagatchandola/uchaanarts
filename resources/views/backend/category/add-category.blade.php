@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Category</h1>
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
                                        <form role="form" name="add-category-form" action="{{ route('add-category') }}" method="post">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input class="form-control" name="cat-name" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Category Image</label>
                                                <input class="form-control" type="file" name="cat-image" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input class="form-control" type="textarea" name="description" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>GST</label>
                                                <input class="form-control" type="text" name="gst" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="active" value="1" >Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="inactive" value="0" >Inactive
                                                </label>                                                
                                            </div>
                                            
                                            <button type="submit" class="btn btn-default">Submit Button</button>
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