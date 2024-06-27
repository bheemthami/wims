
<div class="col-md-12">

	<div class="col-md-4 form-group">
		<label for="name">Grading System<span>*</span></label>
		{!! Form::select('grading_system_id',$gradingSystemOptions,null,['class'=>'form-control','autofocus'=>true]) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('year')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Academic Year (BS)<span>*</span></label>
		{!! Form::text('year',null,['class'=>'form-control','autofocus'=>true,'placeholder'=>'Academic Year']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('year')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Academic Year (AD) <span>*</span></label>
		{!! Form::text('year_eng',null,['class'=>'form-control','autofocus'=>true,'placeholder'=>'Academic Year']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('year_eng')}}</i></span> 
		@endif 
	</div>

</div>
<div class="col-md-12">

	<div class="col-md-4 form-group">
		<label for="name">Total School opening days <span>*</span></label>
		{!! Form::number('school_open_days',null,['class'=>'form-control','autofocus'=>true,'placeholder'=>'school open days']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('school_open_days')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">No of exams <span>*</span></label>
		{!! Form::number('no_of_exams',null,['class'=>'form-control','autofocus'=>true,'placeholder'=>'no of exams']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('no_of_exams')}}</i></span> 
		@endif 
	</div>
</div>


