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
                            echo '<pre>';
                            print_r($artist);exit;
                        }
                        
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
