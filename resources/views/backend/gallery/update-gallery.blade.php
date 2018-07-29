@extends('backend.layouts.app')
@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Approve Artist Uploaded Image</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" name="update-gallery-form" action="{{ route('update-pending-gallery', [$art->id]) }}" method="post">
                                            <input type="hidden" name="art-id" value="{{ $art->id }}" />
                                            <div class="form-group">
                                                <label>Artist Name: <strong>{{ $art->uname }}</strong></label>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Image: <img src="{{ \App\Helpers\Helper::getImage($art->fname .'.'. $art->ext, 0) }}" width="100" height="100"></label>
                                            </div>
                                            
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
                                                <input class="form-control" type="text" name="commission" value="{{ config('app.commission') }}" readonly="readonly">
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
                                            <div class="form-group">
                                                <label>Approve</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="yes" value="1">Yes
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="no" value="0">No
                                                </label>                                                
                                            </div>
                                            
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
