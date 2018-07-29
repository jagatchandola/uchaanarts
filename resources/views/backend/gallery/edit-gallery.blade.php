@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Artist Uploaded Image</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" name="edit-gallery-form" action="{{ route('edit-gallery-post') }}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="artist-id" value="{{ $art->artist_id }}" />
                                            <input type="hidden" name="art-id" value="{{ $art->id }}" />
                                            <div class="form-group">
                                                <label>Artist Name: <strong>{{ $art->uname }}</strong></label>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Image: <img src="{{ \App\Helpers\Helper::getImage($art->fname .'.'. $art->ext, 0) }}" width="100" height="100"></label>
                                            </div>
                                            
                                            @can('isArtist')
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input class="form-control" type="file" name="image" value="">
                                            </div>
                                            @endcan
                                            
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" type="text" name="title" value="{{ $art->title }}">
                                            </div>
                                            <div class="form-group">
                                                <label>About Image</label>
                                                <input class="form-control" type="textarea" name="about" value="{{ $art->about }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input class="form-control" type="textarea" name="price" value="{{ $art->price }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Commission(%)</label>
                                                <input class="form-control" type="text" name="commission" value="30" readonly="readonly">
                                            </div>
                                            
                                            @can('isAdmin')
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
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="active" value="1" @if($art->active == 1) checked @endif>Active
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="inactive" value="0" @if($art->active == 0) checked @endif>Inactive
                                                    </label>                                                
                                                </div>
                                            @endcan
                                            
                                            <div class="form-group">
                                                <label>Total Price: {{ $totalPrice }}</label>
                                                                                               
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

@section('script')
<script src="{{ asset('backend/js/dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables').DataTable({
                responsive: true,
                "lengthMenu": [20,30,40,50]
            });
        });
        
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
    </script>
@endsection