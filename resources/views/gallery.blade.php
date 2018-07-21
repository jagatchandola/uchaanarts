@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Creative Art Work</h3>
                </div>

                <div>
                    @if(!empty($categories))
                        <a href="gallery">All</a>
                        @foreach($categories as $category)
                            <p>
                                <a href="/art-gallery/{{$category->cat_url}}">{{$category->cat_name}}</a>
                            </p>
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                    
                    <?php 
                        if (empty($arts)) {
                            echo 'No record(s) found';
                        } else {
                            foreach ($arts as $art) {
                                //echo '<pre>';print_r($art);exit;
                             
                    ?>
                    <div class="card-body">
                            <!-- <img src="images/{{ $art->fname }}" alt="" width="150" height="150" /> -->
                            <a href="/artists/{{ $art->artist_id}}/{{ $art->id}}">
                                <img src="/images/dummy.jpg" alt="" width="150" height="150" />
                                <span>{{ $art->title }}</span><br>
                                <span>rs. {{ $art->totalPrice }}</span><br>
                                <span>By {{$art->uname}}</span>
                            </a>
                    </div>
                    <?php } } ?>
                </div>
                {{$arts->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
