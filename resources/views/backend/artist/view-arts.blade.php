@extends('backend.layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/lightbox.min.css') }}">
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/js/lightbox-plus-jquery.min.js')}}"></script>
@endsection

@section('content')

            <div id="page-wrapper">
            <div class="clearfix">
                <h1 class="page-header">Artist Products</h1>
            </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                @if(count($arts) == 0)
                                    <div class="dataTable_wrapper">
                                        No record(s) found
                                    </div>
                                @else
                                    @foreach($arts as $art)
                                    <div class="col-sm-3">
                                        <a href="{{ \App\Helpers\Helper::getImage($art['username'].'/imgs/'.$art['fname'] .'.'. $art['ext'], 1) }}" data-lightbox="{{$art['id']}}">
                                        <img src="{{ \App\Helpers\Helper::getImage($art['username'].'/imgs/'.$art['fname'] .'.'. $art['ext'], 1) }}" width="100" height="100" />
                                        </a><br/>
                                        <span>{{ $art['title'] }}</span><br/>
                                        <span><b>By:</b> {{ $art['uname'] }}</span><br/>
                                        <span>Rs. {{ $art['price'] }}</span>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <a href="{{ route('pending-artists') }}"><button  class="btn btn-primary" type="button">Back</button></a>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            <div class="col-md-12 col-sm-12 clearfix"></div>
        </div>
        <!-- /#wrapper -->
@endsection
