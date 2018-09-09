@extends('layouts.app')

@section('content')
<section class="themeSec1 bgWhite">
    <div class="container">
        <div class="col-sm-12 col-md-8 offset-2" style="margin: o auto;">
        <h1>{{ __('Product Enquiry Form') }}</h1>

        <div class="registerBox">
        @if(Session::has('success_message'))
        <div class="alert alert-success" id="success-div">
            <a href="#" class="close">&times;</a>
            <strong>Success!</strong> <span>{{session('success_message')}}</span>
        </div>
        @endif
        @if(Session::has('error_message'))
        <div class="alert alert-danger" id="error-div">
            <a href="#" class="close">&times;</a>
            <strong>Error!</strong> <span>{{session('error_message')}}</span>
        </div>
        @endif
            <form method="POST" action="{{ route('product-enquiry', $product_id) }}" aria-label="{{ __('Enquiry') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product_id }}" />
                <div class="form-group row">
                    
                    <div class="col-sm-6 col-md-12 col-lg-12 col-12">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" required pattern="[A-Za-z\s]{3,25}" title="Invalid name. Min 3 and max 25 characters are allowed">
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-sm-6 col-md-12 col-lg-12 col-12">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                    </div>
                </div>
                <div class="form-group row">
                   
                    <div class="col-sm-6 col-md-12 col-lg-12 col-12">
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    
                    <div class="col-sm-6 col-md-12 col-lg-12 col-12">
                        <textarea class="form-control" id="comments" name="comments" placeholder="Comments" rows="5" required></textarea>
                    </div>
                </div>                
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label"></label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <button type="submit" class="btn btn-primary themeBtn">{{ __('Submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        
        $('.close').on('click', function(){
            $(this).parent('#success-div').addClass('hide');
            $(this).parent('#error-div').addClass('hide');
        });
    });
</script>
@endsection
