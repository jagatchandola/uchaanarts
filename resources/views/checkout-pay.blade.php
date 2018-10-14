@extends('layouts.app')

@section('content')
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <div class="container">
    <h1>Check Out</h1>
	
	 <div class="shoppingCart">
	 <div class="row">
       <div class="table-responsive">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Image</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @if(!empty($cartItems))
                @foreach($cartItems as $productDetail)
                    <tr>
                      <th scope="row">{{ $productDetail->title }}</th>
                      <td width="15%"><a href="{{ \App\Helpers\Helper::getImage($productDetail->username . '/imgs/' . $productDetail->fname . '.' . $productDetail->ext, 1) }}" data-spzoom><img class="card-img-top img-fluid" src="{{ \App\Helpers\Helper::getImage($productDetail->username . '/imgs/' . $productDetail->fname . '.' . $productDetail->ext, 1) }}" alt=""></a></td>
                      <td>1</td>
                      <td>INR {{ \App\Helpers\Helper::getFormattedPrice($productDetail->totalPrice) }}</td>
                      <td><strong>INR {{ \App\Helpers\Helper::getFormattedPrice($productDetail->quantity * $productDetail->totalPrice) }}</strong></td>
                    </tr>
                    
                    @php
                        $totalPrice += $productDetail->totalPrice;
                    @endphp
                @endforeach
              @else
                No record(s) found
              @endif
            </tbody>
          </table>
		  <hr>
        </div>
		
		<div class="col-6 offset-6">
		
		    <table class="table table-bordered">
			 <tbody>
   
    <tr>
      <th scope="row">Subtotal</th>
      <td>INR {{ \App\Helpers\Helper::getFormattedPrice($totalPrice) }}</td>

    </tr>
    <tr>
      <th scope="row">Total</th>
      <td colspan="2">INR {{ \App\Helpers\Helper::getFormattedPrice($totalPrice) }}</td>
    </tr>
  </tbody>
			</table>
                        @if(Auth::check())
                            <a href="#" class="btn btn-primary themeBtn float-right " id="loadMore">Checkout</a>
                        @else
                            <a href="{{route('login')}}" class="btn btn-primary themeBtn float-right " id="loadMore">Checkout</a>
                        @endif
		</div>
	 </div>
	 </div>
	
    
  </div>
</section>

<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.spzoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $('[data-spzoom]').spzoom();
    });
</script>

@endsection
