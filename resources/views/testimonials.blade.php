@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Testimonials</h3>
                </div>

                <div class="card-body">
                    
                    @foreach($testimonails as $testimonail)
                    <img src="/images/{{$testimonail->image}}" alt="" width="150" height="150" /><br/>
                        <span>{{ $testimonail->content }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
