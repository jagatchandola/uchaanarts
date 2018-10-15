
<div class="alert alert-success d-none" id="success-div">
    <a href="#" class="close">&times;</a>
    <strong>Success!</strong> <span></span>
</div>

<div class="alert alert-danger d-none" id="error-div">
    <a href="#" class="close">&times;</a>
    <strong>Error!</strong> <span></span>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		@if(Session::has('success_message'))
		  $('#success-div').removeClass('d-none');
		  $('#success-div').find('span').html("{{session('success_message')}}")
		@endif
		@if(Session::has('error_message'))
		  $('#error-div').removeClass('d-none');
		  $('#error-div').find('span').html("{{session('error_message')}}")
		@endif
		$('.close').on('click', function(){
			$(this).parent('#success-div').addClass('d-none');
			$(this).parent('#error-div').addClass('d-none');
		});
	});
</script>

