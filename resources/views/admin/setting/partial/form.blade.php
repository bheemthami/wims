<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="name">Local Level <span>*</span></label>
			{!! Form::text('municipality',null,['class'=>'form-control','placeholder'=>'Local Level','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('municipality')}}</i></span> 
			@endif 
		</div>

		<div class="form-group">
			<label for="name">School Name <span>*</span></label>
			{!! Form::text('office',null,['class'=>'form-control','placeholder'=>'Office','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('office')}}</i></span> 
			@endif
		</div>

		<div class="form-group">
			<label for="name">School Address<span>*</span></label>
			{!! Form::text('office_address',null,['class'=>'form-control','placeholder'=>'Office Address','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('office_address')}}</i></span> 
			@endif
		</div>

		<div class="form-group">
			<label for="name">Province Name <span>*</span></label>
			{!! Form::text('province_name',null,['class'=>'form-control','placeholder'=>'Province Name','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('province_name')}}</i></span> 
			@endif
		</div>

		<div class="form-group">
			<label for="name">Province No. <span>*</span></label>
			{!! Form::text('province_no',null,['class'=>'form-control','placeholder'=>'Province No.','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('province_no')}}</i></span> 
			@endif
		</div>

		<div class="form-group">
			<label for="name">District Name <span>*</span></label>
			{!! Form::text('district_name',null,['class'=>'form-control','placeholder'=>'district','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('district_name')}}</i></span> 
			@endif
		</div>

		<div class="form-group">
			<label for="name">Phone <span>*</span></label>
			{!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'Phone','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('phone')}}</i></span> 
			@endif
		</div>

		<div class="form-group">
			<label for="name">Email <span>*</span></label>
			{!! Form::email('email',null,['class'=>'form-control','placeholder'=>'example@gmail.com','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('email')}}</i></span> 
			@endif
		</div>

		
		<div class="form-group">
			<label for="name">Per Page <span>*</span></label>
			{!! Form::number('per_page',null,['id'=>'perPage','class'=>'form-control','placeholder'=>'per page','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('per_page')}}</i></span> 
			@endif
		</div>
	</div>

	<div class="col-md-6">

		<div class="form-group">
			<label for="name">Logo</label>
			{!! Form::file('logo',null,['class'=>'form-control']) !!}
			<img class="image img-responsive" src="{{ asset('uploads/setting/'.$setting->logo) }}" height="100" width="100" alt="LOGO">
		</div>

		<div class="form-group">
			<label for="name">Website main Logo</label>
			{!! Form::file('local_logo',null,['class'=>'form-control']) !!}
			<img class="image img-responsive" src="{{ asset('uploads/setting/'.$setting->local_logo) }}" height="100" width="100" alt="LOCAL LOGO">
		</div>

		<div class="form-group">
			<label for="name">Favicon</label>
			{!! Form::file('favicon',null,['class'=>'form-control']) !!}
			<img class="image img-responsive" src="{{ asset('uploads/setting/'.$setting->favicon) }}" height="100" width="100" alt="FAVICON">
		</div>


		<div class="form-group">
			<label for="name">System Name <span>*</span></label>
			{!! Form::text('system_name',null,['class'=>'form-control','placeholder'=>'System Name','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('systme_name')}}</i></span> 
			@endif 
		</div>

		<div class="form-group">
			<label for="name">System Short Name <span>*</span></label>
			{!! Form::text('system_short_name',null,['class'=>'form-control','placeholder'=>'System Short Name','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('system_short_name')}}</i></span> 
			@endif
		</div>

		<div class="form-group">
			<label for="name">Tag Line <span>*</span></label>
			{!! Form::text('tag_line',null,['class'=>'form-control','placeholder'=>'System Short Name','required'=>'required']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('tag_line')}}</i></span> 
			@endif
		</div>
	</div>
</div>

