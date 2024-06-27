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
		<label for="name">Email<span>*</span></label>
		{!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
		@if($errors->has('email'))      
		<span class="text-danger"><i>{{$errors->first('email')}}</i></span> 
		@endif 
	</div>
</div>

<div class="col-md-12">
	<div class="form-group col-md-4">
		<label for="name">Role <span>*</span></label>
		{!! Form::select('role_id',$roleOptions,null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('role_id')}}</i></span> 
		@endif 
	</div> 
	
	<div class="form-group col-md-4">
		<label for="name">Password <span>*</span></label>
		{!! Form::password('password',['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('password')}}</i></span> 
		@endif 
	</div>
	<div class="form-group col-md-4">
		<label for="name">Confirm password<span>*</span></label>
		{!! Form::password('password_confirmation',['class'=>'form-control']) !!}
		@if($errors->has('email'))      
		<span class="text-danger"><i>{{$errors->first('password_confirmation')}}</i></span> 
		@endif 
	</div>
</div>

