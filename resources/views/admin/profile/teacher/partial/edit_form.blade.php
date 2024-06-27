<fieldset class="fieldset-border">
	<legend class="legend-border">Personel Details</legend>

	<div class="col-md-4 form-group">
		<label for="name">First Name <span>* </span></label>
		{!! Form::text('first_name',$profile->first_name,['class'=>'form-control','placeholder'=>'Name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.first_name')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Middle Name <span></span></label>
		{!! Form::text('middle_name',$profile->middle_name,['class'=>'form-control','placeholder'=>'Middle Name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.middle_name')}}</i></span> 
		@endif 
	</div>
	<div class="col-md-4 form-group">
		<label for="name">Last Name <span>* </span></label>
		{!! Form::text('last_name',$profile->last_name,['class'=>'form-control','placeholder'=>'Last Name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.last_name')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">DOB(BS) <span>*</span></label>
		{!! Form::text('dob',$profile->dob,['id'=>'bs_dob','data-date-format'=>'yyyy-mm-dd','class'=>'form-control','placeholder'=>'YYYY-MM-DD']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.dob')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Gender <span>*</span></label>
		{!! Form::select('gender',$data['gender_options'],$profile->gender,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.gender')}}</i></span> 
		@endif 
	</div>
</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Address Details</legend>
	<div class="col-md-3 form-group">
		<label for="name">District <span>*</span></label>
		{!! Form::text('district',$profile->district,['class'=>'form-control','placeholder'=>'District']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.district')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Local Level Type  <span>*</span></label>
		{!! Form::select('local_level_type_id',$data['lltype_options'],$profile->local_level_type_id,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.local_level_type_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Local Level Name <span>*</span></label>
		{!! Form::text('municipality',$profile->municipality,['class'=>'form-control','placeholder'=>'local level name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.municipality')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Ward no <span>*</span></label>
		{!! Form::number('ward_no',$profile->ward_no,['class'=>'form-control','placeholder'=>'Ward No.']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.ward_no')}}</i></span> 
		@endif 
	</div>
</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Contact Details</legend>
	<div class="col-md-3 form-group">
		<label for="name">Email </label>
		{!! Form::text('email',$profile->email,['class'=>'form-control','placeholder'=>'email','readOnly'=>true]) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.email')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Mobile <span>*</span></label>
		{!! Form::text('mobile',$profile->mobile,['class'=>'form-control','placeholder'=>'mobile']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.mobile')}}</i></span> 
		@endif 
	</div>
</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Academic Degree Details</legend>
	<div class="col-md-3 form-group">
		<label for="name">Academic Degree <span>*</span></label>
		{!! Form::text('degree',$profile->degree,['class'=>'form-control','placeholder'=>'Degree']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.degree')}}</i></span> 
		@endif 
	</div>
	<div class="col-md-3 form-group">
		<label for="name">Major Subject <span>*</span></label>
		{!! Form::text('major_subject',$profile->major_subject,['class'=>'form-control','placeholder'=>'Major Subject']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.major_subject')}}</i></span> 
		@endif 
	</div>
	<div class="col-md-3 form-group">
		<label for="name">Date of joining <span>*</span></label>
		{!! Form::text('joining_date',$profile->joining_date,['id'=>'joining_date','class'=>'form-control','placeholder'=>'yyyy-mm-dd','readOnly'=>true]) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('teacher.joining_date')}}</i></span> 
		@endif 
	</div>
 
</fieldset>



