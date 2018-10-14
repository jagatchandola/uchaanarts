@extends('backend.layouts.app')

@section('content')

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Event</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" id="edit-event-form" name="edit-event-form" action="{{ route('edit-online-event', $event['id']) }}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="event-id" value="{{ $event['id'] }}" />
                                            <div class="form-group">
                                                <label>Event Title</label>
                                                <input class="form-control" name="event-name" value="{{ $event['etitle'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Event Image</label>
                                                <img src="{{ \App\Helpers\Helper::getImage($event['eurl'].'/'.$event['banner'], 3) }}" width="100" height="100" />
                                                <input class="form-control" type="file" name="image" id="image" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>About Event</label>
                                                <textarea class="form-control" type="textarea" name="about" required>{{ $event['about'] }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input class="form-control" type="date" name="start_date" id="start_date" value="{{ $event['start_date'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $event['end_date'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>First Prize Amount</label>
                                                <input class="form-control" type="number" name="first_prize" value="{{ $event['first_prize'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Second Prize Amount</label>
                                                <input class="form-control" type="number" name="second_prize" value="{{ $event['second_prize'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Third Prize Amount</label>
                                                <input class="form-control" type="number" name="third_prize" value="{{ $event['third_prize'] }}" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Fourth Prize Amount</label>
                                                <input class="form-control" type="number" name="fourth_prize" value="{{ $event['fourth_prize'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Fifth Prize Amount</label>
                                                <input class="form-control" type="number" name="fifth_prize" value="{{ $event['fifth_prize'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Sixth Prize Amount</label>
                                                <input class="form-control" type="number" name="sixth_prize" value="{{ $event['sixth_prize'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Seventh Prize Amount</label>
                                                <input class="form-control" type="number" name="seventh_prize" value="{{ $event['seventh_prize'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Eighth Prize Amount</label>
                                                <input class="form-control" type="number" name="eighth_prize" value="{{ $event['eighth_prize'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Ninth Prize Amount</label>
                                                <input class="form-control" type="number" name="ninth_prize" value="{{ $event['ninth_prize'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tenth Prize Amount</label>
                                                <input class="form-control" type="number" name="tenth_prize" value="{{ $event['tenth_prize'] }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Status</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="active" value="1" @if($event['shide'] == 1) checked @endif>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" id="inactive" value="0" @if($event['shide'] == 0) checked @endif>Inactive
                                                </label>                                                
                                            </div>

                                            <input type="hidden" name="path" value="{{ $event['eurl'] }}" required>
                                            <input type="hidden" name="banner" value="{{ $event['banner'] }}" required>
                                            
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

        if ($('#image').val() != '') {
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
        }
        $('#edit-event-form').submit();
    }
</script>        
@endsection
