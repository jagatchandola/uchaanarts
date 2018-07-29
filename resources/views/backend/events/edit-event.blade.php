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
                                        <form role="form" name="edit-event-form" action="{{ route('edit-event-post') }}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="event-id" value="{{ $event['id'] }}" />
                                            <div class="form-group">
                                                <label>Event Title</label>
                                                <input class="form-control" name="event-name" value="{{ $event['etitle'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Event Image</label>
                                                <img src="{{ \App\Helpers\Helper::getImage($event['banner'], 3) }}" width="100" height="100" />
                                                <input class="form-control" type="file" name="image" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Venue</label>
                                                <input class="form-control" type="textarea" name="venue" value="{{ $event['venue'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>About Event</label>
                                                <input class="form-control" type="textarea" name="about" value="{{ $event['about'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input class="form-control" type="date" name="start_date" value="{{ $event['start_date'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input class="form-control" type="date" name="end_date" value="{{ $event['end_date'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Event Fees</label>
                                                <input class="form-control" type="text" name="event_fees" value="{{ $event['fees'] }}" required>
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