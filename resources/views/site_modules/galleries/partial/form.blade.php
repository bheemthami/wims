<fieldset class="fieldset-border">
	<legend class="legend-border">Details</legend>
	<div class="col-md-12 form-group">
		<label for="name">Title <span>* </span></label>
		{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('title')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Summary <span></span></label>

		<textarea id="summary" name="summary" class="form-control" rows="2" placeholder="summary goes here..."></textarea>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('summary')}} </i></span> 
		@endif 
	</div>


	<div class="col-md-6 form-group">
		<label for="name">Academic Year <span>* </span></label>
		{!! Form::select('academic_year_id',$data['year_options'],$data['setting']->academic_year_id,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('academic_year_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-6 form-group">
		<label for="name">Type <span>* </span></label>
		{!! Form::select('type',$data['type_options'],'image',['id'=>'gallery_type','class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('type')}}</i></span> 
		@endif 
	</div>
	<div class="image-container">
		<div class="col-md-6 form-group">
			<label for="name">Image </label>
			{!! Form::file('image[]',['id'=>'image','multiple'=>'true']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('image')}} </i></span> 
			@endif 
			<span class="text-default">
				<p>
					<i>Files must be less than <strong>10 MB.</strong></i> <br>
					<i>Allowed file types: <strong>png gif jpg jpeg.</strong></i> <br>
				</p>
			</span>		
		</div>
		<div class="row col-md-6">
			<div class="col-md-6 form-group">
				{!! Form::checkbox('is_slider',1,false) !!}
				@if($errors)      
				<span class="text-danger"><i>{{$errors->first('is_slider')}}</i></span> 
				@endif 
				<label for="name">Show on slider </label>
			</div>
		</div>
	</div>
	<div class="video-container">
		<div class="row col-md-12">
			<div class="col-md-6 form-group">
				<label for="name">Video Link <span>* </span></label>
				{!! Form::text('link',null,['class'=>'form-control','placeholder'=>'Title']) !!}
				@if($errors)      
				<span class="text-danger"><i>{{$errors->first('link')}}</i></span> 
				@endif 
			</div>
		</div>
	</div>

</fieldset>
<fieldset class="fieldset-border">

	<legend class="legend-border">Published on website</legend>
	
	<div class="row col-md-12">
		<div class="col-md-6 form-group">
			<label for="name">Publish on website ? <span>*</span></label>
			{!! Form::select('status',$data['publish_options'],0,['class'=>'form-control']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
			@endif 
		</div>
	</div>
	<div class="row col-md-12">
		<div class="col-md-6 form-group">
			<label for="name">Publish date ? <span>*</span></label>
			{!! Form::text('date',null,['class'=>'form-control','id'=>'published_date']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('date')}}</i></span> 
			@endif 
		</div>
	</div>
</fieldset>



