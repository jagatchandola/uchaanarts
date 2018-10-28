@extends('layouts.app')

@section('content')
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
    <div class="container">
        <h1>Shopping Cart</h1>

        <div class="shoppingCart">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-12 col-sm-6">
                    <div class="newcusBx">
                        <h3 class="title">New Customer</h3>
<!--                        <a href="/register.html">Register Account</a><br>
                        <a href="#">Guest Checkout</a><br>-->
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <!--<a class="btn btn-primary themeBtn" href="#">Continue</a>-->
                    </div>
                </div>
                <div class="col-md-4 col-lg-4"></div>
                <div class="col-md-4 col-lg-4 col-12 col-sm-6">
                    <div class="newcusBx">
                        <h3 class="title">Returning Customer</h3>
                        <form id="user-login" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-sm-12 col-md-12 col-lg-12 col-12 col-form-label">Email</label>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-12">
                                    <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-12 col-md-12 col-lg-12 col-12 col-form-label">Password</label>
                                <div class="col-sm-6 col-md-12 col-lg-12 col-12">
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-12">
                                    <button class="btn btn-primary themeBtn" name="login" id="login" type="submit">{{ __('Login') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="registerBox">
            <h2 class="text-left">Enter Your Details</h2>
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" id="user-register" role="form">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">*First Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-12 col-form-label">*Last Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="last_name" name="last_name" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-12 col-form-label">*E-Mail</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-12 col-form-label">*Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="password" name="password" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="phone_no" class="col-sm-12 col-form-label">Phone Number</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="phone_no" name="phone_no" minlength="10" maxlength="10" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_address" class="col-sm-12 col-form-label">*Shipping Address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="shipping_address" name="shipping_address" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="billing_address" class="col-sm-12 col-form-label">*Billing Address </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="billing_address" name="billing_address" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-sm-12 col-form-label">*City </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="city" name="city" required="">
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group row">
                            <label for="pincode" class="col-sm-12 col-form-label">*Pincode </label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="pincode" name="pincode" minlength="6" maxlength="6" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-sm-12 col-form-label">*Country </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="country" name="country" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state" class="col-sm-12 col-form-label">*Region / State </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="state" name="state">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                                <button type="submit" class="btn btn-primary themeBtn" name="register" id="register">Submit</button>
                            </div>
                        </div>
                        <input type="hidden" name="checkout" value="1" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $("#register").click(function(){
            alert('11===');
            $("#user-register").submit();
        });
    });
</script>

@endsection