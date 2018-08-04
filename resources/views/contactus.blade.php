@extends('layouts.app')

@section('content')

<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <div class="container">
   <div class="testimonialBx">
    <h1>Contact Us</h1>
     <div class="row">
      <div class="col-lg-12 col-md-12 col-12 col-sm-12">
      <form id="contact-form" method="POST" action="{{ route('contactus') }}" aria-label="{{ __('Contact Us') }}" role="form">
        @csrf

    <div class="messages"></div>

    <div class="controls">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">First Name *</label>
                    <input id="form_name" type="text" name="fname" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required." pattern="[A-Za-z\s]{3,25}" title="Min 3 and max 25 characters are allowed" value="{{ old('fname') }}">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname">Last Name *</label>
                    <input id="form_lastname" type="text" name="lname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required." pattern="[A-Za-z\s]{3,25}" title="Min 3 and max 25 characters are allowed" value="{{ old('lname') }}">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required." value="{{ old('email') }}" pattern="[a-z0-9\._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                    <div class="help-block with-errors">
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">Phone</label>
                    <input id="form_phone" type="tel" name="mobile" class="form-control" placeholder="Please enter your phone no" maxlength="10" value="{{ old('mobile') }}" pattern="[6-9][0-9]{9}" title="Please enter a valid phone number">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Message *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" value="{{ old('message') }}" data-error="Please,leave us a message."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary themeBtn" value="Send message">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><strong>*</strong> These fields are required.</p>
            </div>
        </div>
    </div>

</form>
      </div>
      </div>
    </div>
  </div>
</section>


@endsection

<script type="text/javascript">
    
</script>
