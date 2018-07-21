@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                    
                    <?php   
                    // echo '<pre>';
                    // print_r($eventDetails);exit;                      
                        if (empty($eventDetails)) {

                            echo 'No record(s) found';
                        } else {                                
                    ?>
                        <div class="card-body">
                                <img src="images/{{ $eventDetails->banner }}" alt="" width="200" height="200" />
                                <span>{{ $eventDetails->etitle }}<br/>
                                    {{date('d-F-Y', strtotime($eventDetails->start_date))}}
                                </span>
                                <p>{{$eventDetails->about}}</p>
                        </div>
                        
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
