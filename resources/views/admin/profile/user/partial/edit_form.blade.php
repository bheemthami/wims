<div class="col-md-12">
	<div class="col-md-6 form-group">
		<label for="name">First Name <span>* </span></label>
		{!! Form::text('first_name',$profile->first_name,['class'=>'form-control','placeholder'=>'Name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('first_name')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-6 form-group">
		<label for="name">Last Name <span>* </span></label>
		{!! Form::text('last_name',$profile->last_name,['class'=>'form-control','placeholder'=>'Last Name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('last_name')}}</i></span> 
		@endif 
	</div>
</div>




