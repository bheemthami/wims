
<div class="form-group">
	<label for="name">Name <span>*</span></label>
	{!! Form::text('name',null,['class'=>'form-control','autofocus'=>true,'placeholder'=>'Name']) !!}
	@if($errors)      
	<span class="text-danger"><i>{{$errors->first('name')}}</i></span> 
	@endif 
</div>
<div class="form-group">
	<label for="name">Order<span>*</span></label>
	{!! Form::number('order',null,['class'=>'form-control','placeholder'=>'order']) !!}
	@if($errors)      
	<span class="text-danger"><i>{{$errors->first('order')}}</i></span> 
	@endif 
</div>