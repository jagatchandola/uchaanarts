
<div class="alert alert-success fade in hide" id="success-div">
    <a href="#" class="close">&times;</a>
    <strong>Success!</strong> <span></span>
</div>

<div class="alert alert-danger fade in hide" id="error-div">
    <a href="#" class="close">&times;</a>
    <strong>Error!</strong> <span></span>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		@if(Session::has('success_message'))
		  $('#success-div').removeClass('hide');
		  $('#success-div').find('span').html("{{session('success_message')}}")
		@endif
		@if(Session::has('error_message'))
		  $('#error-div').removeClass('hide');
		  $('#error-div').find('span').html("{{session('error_message')}}")
		@endif
		$('.close').on('click', function(){
			$(this).parent('#success-div').addClass('hide');
			$(this).parent('#error-div').addClass('hide');
		});
	});
</script>

