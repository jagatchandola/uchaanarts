@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Update Product</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                @include('layouts.alert')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" name="edit-gallery-form" action="{{ route('edit-gallery-post') }}" method="post" enctype="multipart/form-data">
                                        <input class="form-control" type="hidden" name="subject" value="" required>
                                            <input type="hidden" name="artist-id" value="{{ $art->artist_id }}" />
                                            <input type="hidden" name="art-id" value="{{ $art->id }}" />
                                            <div class="form-group">
                                                <label>Artist Name: <strong>{{ $art->uname }}</strong></label>
                                            </div>
                                            
                                            @can('isArtist')
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input class="form-control" type="file" name="image" id="imgInp" value="" @if(empty($art->fname)) required @endif>
                                            </div>
                                            @endcan
                                            
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" type="text" name="title" value="{{ $art->title }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>About Artwork</label>
                                                <textarea class="form-control" name="about" required>{{ $art->about }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input class="form-control" type="textarea" name="price" value="{{ $art->price }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Artwork Code</label>
                                                <input class="form-control" type="text" value="UF-{{ $art->artwork_code }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Year</label>
                                                <input class="form-control" type="text" name="painting" value="{{ $art->painting }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Surface</label>
                                                <input class="form-control" type="text" name="surface" value="{{ $art->surface }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input class="form-control" type="text" name="size" value="{{ $art->size }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <select class="form-control" name="quantity" required>
                                                    @foreach(range(0,10) as $i)
                                                    <option value="{{$i}}" @if($art->quantity == $i) selected @endif>{{$i}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>GST(%)</label>
                                                <input class="form-control" type="text" name="gst" value="{{ $art->gst }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <select class="form-control" name="discount">
                                                    <option value="">Select Discount</option>
                                                    <option value="fixed" @if($art->discount == 'fixed') selected="selected" @endif>Fixed</option>
                                                    <option value="percentage" @if($art->discount == 'percentage') selected="selected" @endif>Percentage</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Discount Value</label>
                                                <input class="form-control" type="text" name="discount_value" value="{{ $art->discount_value }}">
                                            </div>

                                            @can('isAdmin')
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="active" value="1" @if($art->active == 1) checked @endif>Active
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="inactive" value="0" @if($art->active == 0) checked @endif>Inactive
                                                    </label>                                                
                                                </div>
                                                <div class="form-group">
                                                    <label>Creative Art</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="creative_art_status" id="active" value="1" @if($art->is_creative_art == 1) checked @endif>Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="creative_art_status" id="inactive" value="0" @if($art->is_creative_art == 0) checked @endif>No
                                                    </label>                                                
                                                </div>
                                            @endcan
                                            
                                            <a href="{{ route('gallery-list') }}"><button type="button" class="btn btn-primary">Back</button></a> <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="preview-img">
                                        <img id="blah" src="{{ \App\Helpers\Helper::getImage($art->username .'/imgs/'. $art->fname .'.'. $art->ext, 1) }}" alt="your image" width="200px" />
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
<script src="{{ asset('backend/js/dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    
    function changeStatus(id, status) {
        var updateStatus = status == 1 ? 'Active' : 'Inactive';
        var r = confirm("Are you sure, you want to change status to " + updateStatus + "?");
        if (r == true) {
            $.ajax({
                method: "PUT",
                url: "/admin/artists/changeStatus/"+id,
                data: {
                        status:status
                     },
                dataType: "json",
                success: function(response) {
                    if (response == 1) {
                        alert('Status updated successfully!');
                        setTimeout(function() {
                            location.reload(true);    
                        }, 500);
                    } else {
                        alert('Something went wrong. Please try again!');
                        return false;
                    }
                    
                },
                error: function(request,status,errorThrown) {
                   alert('request :'+request,'status : '+status,'errorThrown : '+errorThrown); 
                }
            });
        }
    }
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

     $('#dataTables').DataTable({
            responsive: true,
            "lengthMenu": [20,30,40,50]
        });

    $("#imgInp").change(function() {
        readURL(this);
    });
})

</script>
@endsection