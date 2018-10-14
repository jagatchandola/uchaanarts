@extends('backend.layouts.app')
@section('style')
    <link href="{{ asset('/backend/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Online Event</h1>
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
                                        <form role="form" id="add-event-form" name="add-event-form" action="{{ route('add-online-event') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Event Title</label>
                                                <input class="form-control" name="event_name" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input class="form-control" type="file" name="image" id="image" value="" required accept="image/gif, image/jpeg">
                                            </div>
                                            <div class="form-group">
                                                <label>About</label>
                                                <textarea class="form-control" type="textarea" name="about" value="" required></textarea>
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
                                                <label>Status</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="active" value="1" >Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="inactive" value="0" >Inactive
                                                </label>                                                
                                            </div>
                                            <div class="form-group">
                                                <label>First Prize Amount</label>
                                                <input class="form-control" type="number" name="first_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Second Prize Amount</label>
                                                <input class="form-control" type="number" name="second_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Third Prize Amount</label>
                                                <input class="form-control" type="number" name="third_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Fourth Prize Amount</label>
                                                <input class="form-control" type="number" name="fourth_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Fifth Prize Amount</label>
                                                <input class="form-control" type="number" name="fifth_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Sixth Prize Amount</label>
                                                <input class="form-control" type="number" name="sixth_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Seventh Prize Amount</label>
                                                <input class="form-control" type="number" name="seventh_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Eighth Prize Amount</label>
                                                <input class="form-control" type="number" name="eighth_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Ninth Prize Amount</label>
                                                <input class="form-control" type="number" name="ninth_prize" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tenth Prize Amount</label>
                                                <input class="form-control" type="number" name="tenth_prize" value="" required>
                                            </div>
                                            <button type="button" class="btn btn-primary" onclick="validate()">Submit</button>
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
    function validate() {
        if($('#start_date').val() > $('#end_date').val()) {
            alert('Start date can not be greater than end date!');
            return false;
        }

        var ftype = $('#image')[0].files[0].type;

        switch(ftype)
        {
            case 'image/png':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/jpg':
                break;
            default:
                alert('Unsupported File!');
                return false;
        }
        
        $('#add-event-form').submit();
    }
</script>
@endsection