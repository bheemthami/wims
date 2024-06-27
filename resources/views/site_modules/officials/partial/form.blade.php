<fieldset class="fieldset-border">
	<legend class="legend-border">Personel Details</legend>
	<div class="col-md-4 form-group">
		<label for="name">First Name <span>* </span></label>
		{!! Form::text('first_name',null,['class'=>'form-control','placeholder'=>'Name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('first_name')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Middle Name <span></span></label>
		{!! Form::text('middle_name',null,['class'=>'form-control','placeholder'=>'Middle Name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('middle_name')}}</i></span> 
		@endif 
	</div>
	<div class="col-md-4 form-group">
		<label for="name">Last Name <span>* </span></label>
		{!! Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Last Name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('last_name')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">DOB(BS) <span>*</span></label>
		{!! Form::text('dob',null,['id'=>'bs_dob','data-date-format'=>'yyyy-mm-dd','class'=>'form-control','placeholder'=>'YYYY-MM-DD']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('dob')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Gender <span>*</span></label>
		{!! Form::select('gender',$data['gender_options'],'null',['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('gender')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Image </label>
		{!! Form::file('image',null,['class'=>'form-control']) !!}
		
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('image')}}</i></span> 
		@endif 
	</div>	
</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Address Details</legend>
	<div class="col-md-3 form-group">
		<label for="name">District <span>*</span></label>
		{!! Form::text('district',null,['class'=>'form-control','placeholder'=>'District']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('district')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Local Level Type  <span>*</span></label>
		{!! Form::select('local_level_type_id',$data['lltype_options'],null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('local_level_type_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Local Level Name <span>*</span></label>
		{!! Form::text('municipality',null,['class'=>'form-control','placeholder'=>'local level name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('municipality')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Ward no <span>*</span></label>
		{!! Form::number('ward_no',null,['class'=>'form-control','placeholder'=>'Ward No.']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('ward_no')}}</i></span> 
		@endif 
	</div>
</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Contact Details</legend>
	<div class="col-md-6 form-group">
		<label for="name">Email </label>
		{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'email']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('email')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-6 form-group">
		<label for="name">Mobile <span>*</span></label>
		{!! Form::text('mobile',null,['class'=>'form-control','placeholder'=>'mobile']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('mobile')}}</i></span> 
		@endif 
	</div>

</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Other Details</legend>
	<div class="col-md-3 form-group">
		<label for="name">Academic Year <span>*</span></label>
		{!! Form::select('academic_year_id',$data['year_options'],$data['setting']->academic_year_id,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('academic_year_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Department <span>*</span></label>
		{!! Form::select('department_id',$data['department_options'],null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('department_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Designation <span>*</span></label>
		{!! Form::select('designation_id',$data['designation_options'],null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('designation_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Is working <span>*</span></label>
		{!! Form::select('working_status',$data['working_status_options'],null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('working_status')}}</i></span> 
		@endif 
	</div> 

	<div class="col-md-3 form-group">
		<label for="name">Is teaching official <span>*</span></label>
		{!! Form::select('is_teaching_official',$data['teaching_status_options'],null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('is_teaching_official')}}</i></span> 
		@endif 
	</div> 

	<div class="col-md-3 form-group">
		<label for="name">Date of joining <span>*</span></label>
		{!! Form::text('joining_date',null,['id'=>'joining_date','class'=>'form-control','placeholder'=>'yyyy-mm-dd']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('joining_date')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Date of Leaving</label>
		{!! Form::text('leaving_date',null,['id'=>'leaving_date','class'=>'form-control','placeholder'=>'yyyy-mm-dd']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('leaving_date')}}</i></span> 
		@endif 
	</div>

	
</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Academic Degree Details</legend>
	<div class="col-md-3 form-group">
		<label for="name">Academic Degree </label>
		{!! Form::text('degree',null,['class'=>'form-control','placeholder'=>'Degree']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('degree')}}</i></span> 
		@endif 
	</div> 
</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Website Display Options</legend>
	<div class="col-md-3 form-group">
		<label for="name">Display Order <span>*</span></label>
		{!! Form::number('order',null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('order')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Publish on website ? <span>*</span></label>
		{!! Form::select('status',$data['publish_options'],1,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
		@endif 
	</div>
</fieldset>



