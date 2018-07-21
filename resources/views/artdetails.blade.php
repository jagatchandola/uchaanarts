@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    
                    <?php 
                        if (empty($arts)) {
                            echo 'No record(s) found';
                        } else {
                            foreach ($arts as $art) {
                                // echo '<pre>';print_r($artist);exit;
                             
                    ?>
                    <div class="card-body">
                            <!-- <img src="images/{{ $art->fname }}" alt="" width="150" height="150" /> -->
                                <img src="/images/dummy.jpg" alt="" width="150" height="150" />
                                <span>{{ $art->title }}</span><br>
                                <span>By {{$art->uname}}</span>
                    </div>
                    <?php } } ?>
                </div>

            </div>
        </div>

                @if (!empty($artistOtherArts))
                    <div class="card-header">
                        <h3>Other works by Artist</h3>
                    </div>
                    @foreach($artistOtherArts as $otherArt)
                        <img src="/images/dummy.jpg" alt="" width="150" height="150" />
                        <span>{{ $otherArt['title'] }}</span><br>
                        <span>By {{$otherArt['uname']}}</span>
                    @endforeach
                @endif
    </div>
</div>
@endsection
