@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/ekko-lightbox.css') }}">
@endsection
@section('script')
<!--<script type="text/javascript" src="{{ asset('/js/ekko-lightbox.js')}}"></script>-->
<script type="text/javascript" src="{{ asset('/js/ekko-lightbox.min.js')}}"></script>
@endsection

@section('content')
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <h1>UCHAAN - A Group of Contemporary Artist </h1>
  <div class="container">
   <div class="aboutUsbx">
     <div class="row">
            <div class="col-lg-3 col-md-3 col-12 col-sm-12">
              <img class="card-img-top img-fluid" src="{{ asset('img/a-1.jpg')}}" alt="Card image cap">
                <p class="card-text">Jyoti Kalra</p>
            </div>
            <div class="col-lg-9 col-md-9 col-12 col-sm-12">
              <blockquote class="blockquote aboutBio text-left">
               <h3>Foundation & Director of UCHAAN</h3>
                <p class="mb-0 "><strong>Jyoti Kalra</strong> is a founder of Uchaan arts, a podium that benifits upcoming artists and provides excellent platform for established artist to get worldwide exposure. <br>
Over the years Uchaan has acquired and developed an exotic art collection from artists of varied genre. She has been displaying works of folk artists  to  encourage and promote our traditional art form. This inspires, informs and educates the masses and helps our culture reach a certain height. Over the years Uchaan art has earned its repute of being a serious art promoter.<br>
Besides working with art and artists, she has tremendous administrative skills for organising exhibitions and art events. She keeps up with latest art trends and keeps on researching about artists and their work. She is an adept multitasker who is also good at public relations and marketing artefacts. She has excellent communication skills and using them she has successfully mediated between artists, buyers and the art connoisseurs with great success rates.<br>
<strong>UCHAAN Foundation</strong>, is incorporated as a not-for-profit comapny with a main objective that has established itself as nurtuing ground for a variety of art and varied artists.
Uchaan has a repertoire of not just the masters of art but also an impeccable a range of contemporary artists from all parts of the country, whose works are showcased on a regular basis. Uchaan has been doing shows in all forms of visual arts in its own distinguish way within the gallery as well as hastaken art outside the confines to off site locations. Uchaan has taken the art to masses so as to maximise the reach and lure are enthusiasts far and wide
</p>
              </blockquote>
            </div>
          </div>
   </div>         
  </div>
</section>
<!--Section 1 Ends Here-->

<!--sectionAddcart Start here-->
<div class="sectionAddcart">
 <div class="container">
   <div class="aboutUsbx themeSubs1 ">
       
    @if (!empty($moments))
    <h2>Uchaan Memorable Moments </h2>
        
    @foreach ($moments as $moment)
        <div class="row">
            <div class="col-lg-3 col-md-3 col-12 col-sm-6">
                <div class="artBox"> 
                    <a href="uploads/memorable_moments/{{$moment->image}}" data-toggle="lightbox" data-title="{{$moment->title}}">
                        <img src="uploads/memorable_moments/{{$moment->image}}" class="img-fluid">
                    </a>
                    <h3>{{$moment->title}}</h3>
                </div>
            </div>
        </div> 
    @endforeach
    @endif
  </div>
</div>
</div>
<!--sectionAddcart Ends here-->

<script type="text/javascript">
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
@endsection
