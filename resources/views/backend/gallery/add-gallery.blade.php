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

                                        <input class="form-control" type="hidden" name="subject" value="" required>

                                            <div class="form-group">
                                                <label>Image</label>
                                                <input class="form-control" type="file" name="image" id="imgInp" value="" required>
                                            </div>

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
                                                <label>Title</label>
                                                <input class="form-control" type="text" name="title" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>About Artwork</label>
                                                <textarea class="form-control" name="about" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input class="form-control" type="number" name="price" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Year</label>
                                                <input class="form-control" type="text" name="painting" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Surface</label>
                                                <input class="form-control" type="text" name="surface" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input class="form-control" type="text" name="size" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <select class="form-control" name="quantity" required>
                                                    @foreach(range(0,10) as $i)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>GST(%)</label>
                                                <input class="form-control" type="text" name="gst" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <select class="form-control" name="discount">
                                                    <option value="">Select Discount</option>
                                                    <option value="fixed" selected="selected">Fixed</option>
                                                    <option value="percentage">Percentage</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Discount Value</label>
                                                <input class="form-control" type="text" name="discount_value" value="">
                                            </div>
                                            
                                            @if (Auth::user()->admin_approved == 0)
                                                <button type="submit" class="btn btn-primary">Send Profile for Admin approval</button>
                                            @else
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            @endif
                                        </form>
                                    </div>  
                                    <div class="col-lg-6">
                                        <div class="preview-img">
                                        <img id="blah" src="/image/dummy-400x400.jpg" alt="your image" width="200px" />
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
@endsection

@section('script')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $("#imgInp").change(function() {
            readURL(this);
        });
    })

</script>
@endsection