@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Category</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" name="edit-category-form" action="{{ route('edit-category-post') }}" method="post">
                                            <input type="hidden" name="cat-id" value="{{ $category['id'] }}" />
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input class="form-control" name="cat-name" value="{{ $category['cat_name'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Category Image</label>
                                                <!--<img src="{{ asset('image/'.$category['image']) }}" />-->
                                                <img src="{{ \App\Helpers\Helper::getImage($category['image'], 5) }}" width="100" height="100" />
                                                <input class="form-control" type="file" name="cat-image" value="{{ $category['cat_name'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>GST</label>
                                                <input class="form-control" type="text" name="gst" value="{{ $category['gst'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="active" value="1" @if($category['shide'] == 1) checked @endif>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="inactive" value="0" @if($category['shide'] == 0) checked @endif>Inactive
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

@section('script')
<script src="{{ asset('backend/js/dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables').DataTable({
                responsive: true,
                //iDisplayLength: 20
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