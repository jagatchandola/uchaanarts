@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                    
                    <?php 
                        $upcomingEvents = $pastEvents = false;
                        $currentDate = date('Y-m-d');

                        if (empty($events)) {
                            echo 'No record(s) found';
                        } else {
                            foreach ($events as $event) {
                                //echo '<pre>';print_r($events->eurl);exit;
                                if (strtotime($event->start_date) > strtotime($currentDate)) {
                                    if ($upcomingEvents === false) {
                                        echo '<div class="card-header">
                                                <h3><b>Upcoming Events</b></h3>
                                            </div>';
                                        $upcomingEvents = true;
                                    }
                                
                             
                    ?>
                            <div class="card-body">
                                <a href="events/{{$event->id}}">
                                    <img src="images/{{ $event->banner }}" alt="" width="200" height="200" />
                                    <span>{{ $event->etitle }}<br/>
                                        {{date('d-F-Y', strtotime($event->start_date))}}
                                    </span>
                                </a>
                            </div>
                        <?php 
                            } else {
                                if ($pastEvents === false) {
                                        echo '<div class="card-header">
                                                <h3><b>Past Events</b></h3>
                                            </div>';
                                        $pastEvents = true;
                                    }
                        ?>
                            <div class="card-body">
                                <a href="events/{{$event->id}}">
                                    <img src="images/{{ $event->banner }}" alt="" width="200" height="200" />
                                    <span>{{ $event->etitle }} <br/>
                                        {{date('d-F-Y', strtotime($event->start_date))}}
                                    </span>
                                </a>
                            </div>

                    <?php } } }?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
