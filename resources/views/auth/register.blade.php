@extends('layouts.app')

@section('style')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style type="text/css">
    /* step form start */
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 50%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
    -webkit-appearance: inherit!important;
    opacity: 1!important;
}
/* step form end */
</style>
@endsection

@section('script')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='password'],input[type='radio'],input[type='url'],input[type='number'],input[type='file'],input[type='email'],input[type='date'],textarea"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }
      // if(isValid)
      if(curStep.find('#password').val() != curStep.find('#password_confirmation').val()) {
            isValid = false;
            curStep.find('#password').closest(".form-group").addClass("has-error");
            curStep.find('#password_confirmation').closest(".form-group").addClass("has-error");
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Artist Registration</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="themeSec1 bgWhite">
<div class="container">
  <h1>{{ __('Artist Registration Form') }}</h1>
<div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
        <p>Personal Infomation</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p>Eeducation & Bio</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p>Term & Condition</p>
      </div>
    </div>
  </div>
  
  <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data" role="form">
  <input type="hidden" name="user_role" value="artist" />
  @csrf
    <div class="row setup-content" id="step-1">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3> Personal Infomation</h3>
          <div class="form-group">
            <label class="control-label">Artist Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Artist name" required pattern="[A-Za-z\s]{3,25}" title="Min 3 and max 25 characters are allowed" maxlength="50" minlength="3">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
           <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label class="control-label">Confirm Password</label>
           <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
           <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
          </div>
          <div class="form-group">
            <label class="control-label">Mobile</label>
            <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile" maxlength="10" required>
          </div>
          <div class="form-group">
            <label class="control-label">DOB</label>
            <input type="date" class="form-control" id="dob" name="dob" placeholder="DD/MM/YYYY" required>
          </div>
          <div class="form-group">
            <label class="control-label">Gender</label>
            
                <div class="form-check form-check-inline" style="margin-left: 15px; ">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="m" required checked>
                    <label class="form-check-label" for="inlineRadio1">{{ __('Male') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="f" required>
                    <label class="form-check-label" for="inlineRadio2">{{ __('Female') }}</label>
                </div>
            
          </div>

          <div class="form-group">
            <label class="control-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">City</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
          </div>
           <div class="form-group">
            <label class="control-label">State</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
          </div>
          <div class="form-group">
            <label class="control-label">Pin Code</label>
            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pin Code" required>
          </div>
          <div class="form-group">
            <label class="control-label">Artist Photo</label>
            <input type="file" class="form-control-file" id="artist_image" name="artist_image" required>
          </div>

          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-2">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3> Eeducation & Bio</h3>
          <div class="form-group">
            <label class="control-label">About Me</label>
            <textarea class="form-control" id="about" name="about" rows="4" placeholder="(300 words maximum)" required></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">Award & Recognition</label>
            <textarea class="form-control" id="awards" name="awards" rows="4" placeholder="(300 words maximum)" required></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">Qualification</label>
            <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification" required>
          </div>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3> Term & Condition</h3>
        <div>
            This Site and related Services are provided by Uchaan Arts, with registered office at Sherwood House, 41 Queens Road, Farnborough, Hants, GU14 6JP, UK and registered in India and Wales under Company Number: 10853546. By using Uchaan Art's Site(s), Services and registering with Uchaan Arts as an Artist, you agree to the ‘Terms and Conditions for Registered Artists’, our ‘Site Terms and Conditions’ and our ‘Privacy Policy’, which are subject to change from time to time. These terms and conditions are important regards your registration, you should print and keep a copy of these terms, ‘Site Terms and Conditions’ and ‘Privacy Policy’ for your records as at the date of joining or renewing your registration. Definitions: “Artist” means a person who has registered themselves on our Site(s) as a formally trained actor “Agent” means a third party who has registered themselves as a person, firm, company or organisation using our Site(s) in their search for reviewing and signing Artists “Content” means the information and other material or applications within our Site(s) “New Artist” means those Artists who have not registered with Uchaan Arts before “Premium Profile” means providing the Artist with additional profile features over the standard length of duration subscription order “Services” means services provided by Uchaan Arts that may be made available by us from time to time “Sign”, “Signed”, “Signing” means the process whereby an Agent or third-party has contacted you and notified you in writing or email that you have been registered on that Agent’s books or register “Site”, “Site(s)” means the sites located at www.theartisthub.pro “Us”, “us”, “We”, “we”, “Our”, “our” means Uchaan Arts “You”, “you”, “Your”, “your” means the person, firm, company or organisation browsing and/or using the Site(s) 
        </div>
          <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
        </div>
      </div>
    </div>
  </form>
  
</div>


    <!-- <div class="container">
        <h1>{{ __('Artist Registration Form') }}</h1>
        <div class="registerBox">
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_role" value="artist" />
                <div class="form-group row">
                    <label for="name" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Artist Name') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Artist name" required pattern="[A-Za-z\s]{3,25}" title="Min 3 and max 25 characters are allowed">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Password') }}</label>
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
                    <label for="email" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Email') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email@example.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Mobile') }}</label>
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
                    <label for="dob" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Date of Birth') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="DD/MM/YYYY">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Address') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('City') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pincode" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Pin Code') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pin Code">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="about" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('About Artist') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <textarea class="form-control" id="about" name="about" rows="4" placeholder="(300 words maximum)"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="artist_image" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Artist Photo') }}</label>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-12">
                        <input type="file" class="form-control-file" id="artist_image" name="artist_image">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="qualification" class="col-sm-6 col-md-3 col-lg-3 col-12 col-form-label">{{ __('Qualification') }}</label>
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
    </div> -->
</section>
@endsection
