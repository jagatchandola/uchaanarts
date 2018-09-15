@extends('backend.layouts.app')
@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Product</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            @include('layouts.alert')
                            
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" name="add-gallery-form" action="{{ route('add-gallery') }}" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="form-control" name="category" required>
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input class="form-control" type="file" name="image" value="" required>
                                            </div>                                            
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" type="text" name="title" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>About Image</label>
                                                <textarea class="form-control" name="about" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input class="form-control" type="number" name="price" value="" required>
                                            </div>
                                            
                                            @if (Auth::user()->admin_approved == 0)
                                                <button type="submit" class="btn btn-primary">Send Profile for Admin approval</button>
                                            @else
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            @endif
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