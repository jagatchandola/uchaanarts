@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Event</h1>
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
                                        <form role="form" id="add-event-form" name="add-event-form" action="{{ route('add-event') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Event Title</label>
                                                <input class="form-control" name="event_name" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input class="form-control" type="file" name="image" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Venue</label>
                                                <input class="form-control" type="textarea" name="venue" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>About</label>
                                                <input class="form-control" type="textarea" name="about" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input class="form-control" type="date" name="start_date" id="start_date" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input class="form-control" type="date" name="end_date" id="end_date" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Event Fees</label>
                                                <input class="form-control" type="text" name="event_fees" value="" required>
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
                                            
                                            <button type="button" class="btn btn-primary">Submit</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        if($('#start_date').val() > $('#end_date').val()) {
            alert('Start date can not b greater than end date!');
            return false;
        }
        return false;
        $('#add-event-form').submit();
    });
</script>
@endsection