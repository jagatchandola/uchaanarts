@extends('backend.layouts.app')


@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Profile</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                @include('layouts.alert')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    
                                    <form role="form" name="edit-artist-form" action="{{ route('artist-profile') }}" method="post" enctype="multipart/form-data">
                                        <div class="col-lg-6">
                                            
                                           
                                            <div class="form-group">
                                                <img src="{{ \App\Helpers\Helper::getImage($artist->username .'/'. $artist->profimg, 1) }}" width="100" height="100">
                                                <input class="form-control" type="file" name="image" value="">

                                            </div>
                                        </div>   
                                        <div class="clearfix"></div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input class="form-control" name="uname" value="{{ $artist->uname }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">    
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="text" name="email" value="{{ $artist->email }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input class="form-control" type="text" name="address" value="{{ $artist->address }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input class="form-control" type="text" name="city" value="{{ $artist->city }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">    
                                            <div class="form-group">
                                                <label>State</label>
                                                <input class="form-control" type="text" name="state" value="{{ $artist->state }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">    
                                            <div class="form-group">
                                                <label>Zip Code</label>
                                                <input class="form-control" type="text" name="pcode" value="{{ $artist->pcode }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">    
                                            <div class="form-group">
                                                <label>DOB</label>
                                                <input class="form-control" type="date" name="dob" value="{{ $artist->dob }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">    
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input class="form-control" type="number" name="phone" value="{{ $artist->phone }}" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">    
                                            <div class="form-group">
                                                <label>Education</label>
                                                <input class="form-control" type="text" name="education" value="{{ $artist->education }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">    
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input class="form-control" type="text" name="website" value="{{ $artist->website }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>About</label>
                                                <textarea class="form-control" name="about">{{ $artist->about }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>About2</label>
                                                <textarea class="form-control" name="about2">{{ $artist->about2 }}</textarea>
                                            </div>
                                        </div>
                                            
                                        <div class="col-lg-12">    
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                                                    
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
        $(document).ready(function() {
           
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