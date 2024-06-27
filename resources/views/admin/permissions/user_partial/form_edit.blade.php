<div class="col-md-12">
	<div class="form-group col-md-4">
		<label for="name">First Name <span>*</span></label>
		{!! Form::text('first_name',null,['class'=>'form-control','autofocus'=>true,'placeholder'=>'first name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('first_name')}}</i></span> 
		@endif 
	</div>

	<div class="form-group col-md-4">
		<label for="name">Last Name <span>*</span></label>
		{!! Form::text('last_name',null,['class'=>'form-control','placeholder'=>'last name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('last_name')}}</i></span> 
		@endif 
	</div>

	<div class="form-group col-md-4">
		<label for="name">Last Name <span>*</span></label>
		{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'example@gmail.com']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('email')}}</i></span> 
		@endif 
	</div>
</div>