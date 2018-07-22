@extends('layouts.app')

@section('content')
<section class="themeSec1 bgWhite">
  <div class="container">
    <h1>{{ __('Artist Registration Form') }}</h1>
    <div class="registerBox">
      <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
          @csrf
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Artist Name') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="text" id="name" name="name" class="form-control" id="" placeholder="Artist name">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Password') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group row">
          <label for="password_confirmation" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Confirm Password') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Email') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="text" class="form-control" id="email" name="email" placeholder="email@example.com">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Mobile') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Gender') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="m">
              <label class="form-check-label" for="inlineRadio1">{{ __('Male') }}</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="f">
              <label class="form-check-label" for="inlineRadio2">{{ __('Female') }}</label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Date of Birth') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="date" class="form-control" id="dob" name="dob" placeholder="DD/MM/YYYY">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Address') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <textarea class="form-control" id="address" name="address" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('City') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="text" class="form-control" id="city" name="city" placeholder="City">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Pin Code') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pin Code">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('About Artist') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <textarea class="form-control" id="about" name="about" rows="4" placeholder="(300 words maximum)"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Artist Photo') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="file" class="form-control-file" id="artist_image" name="artist_image">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Qualification') }}</label>
          <div class="col-sm-6 col-md-9 col-lg-9 col-12">
              <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification">
          </div>
        </div>
        <div class="form-group row">
        <label for="staticEmail" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label"></label>
        <div class="col-sm-6 col-md-9 col-lg-9 col-12">
          <button type="submit" class="btn btn-primary themeBtn" href="#">{{ __('Submit') }}</button>
        </div>
		</div>
      </form>
    </div>
  </div>
</section>
@endsection
