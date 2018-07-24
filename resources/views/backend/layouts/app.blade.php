<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Uchaan Arts - Admin</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('backend/css/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="{{ asset('backend/css/timeline.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('backend/css/startmin.css') }}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{ asset('backend/css/morris.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('backend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        @yield('style')
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery -->
        <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    </head>
    <body>
      <div id="wrapper">
            @auth
                @include('backend.layouts.sidebar')  
            @endauth
            
            @yield('content')
        </div>
        <!-- /#page-wrapper -->


        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{ asset('backend/js/raphael.min.js') }}"></script>
        <!--<script src="{{ asset('backend/js/morris.min.js') }}"></script>-->
        <!--<script src="{{ asset('backend/js/morris-data.js') }}"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('backend/js/startmin.js') }}"></script>

        @yield('script')
    </body>
</html>