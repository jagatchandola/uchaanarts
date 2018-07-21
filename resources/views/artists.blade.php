@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Modern Artists</h3>
                </div>

                <div class="card-body">
                    
                    <?php 
                        if (empty($artists)) {
                            echo 'No record(s) found';
                        } else {
                            foreach ($artists as $artist) {
                                // echo '<pre>';print_r($artist);exit;
                             
                    ?>
                    <div class="card-body">
                        <a href="#">
                            <!-- <img src="images/{{ $artist->profing }}" alt="" width="150" height="150" /> -->
                            <a href="artists/{{ $artist->id}}">
                                <img src="images/dummy.jpg" alt="" width="150" height="150" />
                                <span>{{ $artist->uname }}</span>
                            </a>
                        </a>
                    </div>
                    <?php } } ?>
                </div>
                @if ($artists->lastPage() > 1)
                    <div>{{$artists->lastPage()}}</div>
                @endif
                {{$artists->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
