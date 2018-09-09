@extends('layouts.app')

@section('content')
<script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
<section class="themeSec1 bgWhite">
    <div class="container">
        @include('layouts.alert')
        <h1>{{ __('Product Enquiry Form') }}</h1>
        <div class="registerBox">
            <form method="POST" action="{{ route('product-enquiry', $product_id) }}" aria-label="{{ __('Enquiry') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product_id }}" />
                <div class="form-group row">
                    <label for="name" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Name') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" required pattern="[A-Za-z\s]{3,25}" title="Invalid name. Min 3 and max 25 characters are allowed">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Email') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Mobile') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="comments" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Comments') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <textarea class="form-control" id="comments" name="comments" rows="5" required></textarea>
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
</section>
@endsection
