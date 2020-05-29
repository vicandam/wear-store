@if($errors->any())
  
	<div class="alert-wrapper-fixed">
		

		   <div class="alert alert-danger">
		   	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 18px;">&times;</span></button>
	    
		    @foreach($errors->all() as $error)

		      <p>{{ $error }}</p>

		    @endforeach
		    
		  </div>
	</div>  

@endif