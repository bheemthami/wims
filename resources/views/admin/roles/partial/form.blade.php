<div class="form-group">
	<label for="name">Role <span>*</span></label>
	{!! Form::text('name',null,['class'=>'form-control','autofocus'=>true,'placeholder'=>'name']) !!}
	@if($errors)      
	<span class="text-danger"><i>{{$errors->first('name')}}</i></span> 
	@endif 
</div>