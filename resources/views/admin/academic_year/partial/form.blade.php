<div class="col-md-12">
	<div class="col-md-4 form-group">
		<label for="name">Academic Year (BS)<span>*</span></label>
		{!! Form::text('year',null,['class'=>'form-control','autofocus'=>true,'placeholder'=>'Academic Year']) !!}
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('year')}}</i></span>
		@endif
	</div>
</div>
