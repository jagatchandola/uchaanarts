@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <h1>Current Events</h1>
  <div class="container">
   <div class="eventsBox">
  <div class="row">
        @if(empty($currentEvents))
            <div> There are no current events exists.</div>
        @else
        @foreach($currentEvents as $event)
           <div class="col-lg-4 col-md-4 col-12 col-sm-6">
             <div class="artBox"> <div class="imgFixbx"><a href="/events/{{$event->id}}"><img src="{{ \App\Helpers\Helper::getImage($event->eurl.'/'.$event->banner, 3) }}" class="img-fluid"></a></div>
                <h3>{{ $event->etitle }} @if(!empty($event->category)) <small>({{$event->category}})</small> @endif</h3>
                <span>{{date('d/F/Y', strtotime($event->start_date))}}</span>
                <span>{{ $event->venue }}</span>
            
             </div>
           </div>
       @endforeach
       @endif
  
  </div>
  </div>
   </div>
</section>

<section class="themeSec1 ">
  <h1>Upcoming Events</h1>
  <div class="container">
   <div class="eventsBox">
  <div class="row">
        @if(empty($upcomingEvents))
            <div> There are no upcomming events exists.</div>
        @else
        @foreach($upcomingEvents as $event)
           <div class="col-lg-4 col-md-4 col-12 col-sm-6">
             <div class="artBox"> <div class="imgFixbx"><a href="/events/{{$event->id}}"><img src="{{ \App\Helpers\Helper::getImage($event->eurl.'/'.$event->banner, 3) }}" class="img-fluid"></a></div>
                <h3>{{ $event->etitle }} @if(!empty($event->category)) <small>({{$event->category}})</small> @endif</h3>
                <span>{{date('d/F/Y', strtotime($event->start_date))}}</span>
                <span>{{ $event->venue }}</span>
            
             </div>
           </div>
       @endforeach
       @endif
  
  </div>
  </div>
   </div>
</section>

<!--Section 1 Ends Here-->
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <h2>Past Events</h2>
  <div class="container">
   <div class="eventsBox">
  <div class="row">

    @if(!empty($pastEvents))
        @foreach($pastEvents as $event)
            <div class="col-lg-3 col-md-3 col-12 col-sm-6">
                <div class="artBox"> <div class="imgFixbx"><a href="/events/{{$event->id}}"><img src="{{ \App\Helpers\Helper::getImage($event->eurl.'/'.$event->banner, 3) }}" class="img-fluid"></a></div>
                    <h3>{{ $event->etitle }} @if(!empty($event->category)) <small>({{$event->category}})</small> @endif</h3>
                    <span>{{ $event->venue }}</span>
                    <span>{{date('d/F/Y', strtotime($event->start_date))}}</span>
                
                 </div>
            </div>
        @endforeach
    @endif
  </div>
  </div>
   </div>
</section>
<!--Section 1 Ends Here-->

@endsection
