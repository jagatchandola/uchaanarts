@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                    
                    <?php   
//                     echo '<pre>';
//                     print_r($artists);exit;                      
                        if (empty($artists)) {

                            echo 'No record(s) found';
                        } else {                                
                    ?>
                        <div class="card-body">
                                <img src="images/{{ $artists['profimg'] }}" alt="" width="200" height="200" />
                                <p>{{$artists['uname']}}</p>
                        </div>
                        
                    <?php } ?>
                </div>
            </div>

            <div class="card">
                @if(!empty($catalogues))
                    @foreach($catalogues as $catalogue)                
                        <!-- <img src="images/{{ $catalogue['fname'] . $catalogue['ext'] }}" alt="" width="200" height="200" /> -->
                        <img src="/images/dummy.jpg" alt="" width="200" height="200" />
                        <span>{{$catalogue['title']}}</span><br/>
                        <span>{{$catalogue['price']}}</span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
