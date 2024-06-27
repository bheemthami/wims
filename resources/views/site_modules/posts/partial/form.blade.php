<fieldset class="fieldset-border">
	<legend class="legend-border">Details</legend>
	<div class="col-md-12 form-group">
		<label for="name">Title <span>* </span></label>
		{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('title')}}</i></span> 
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
		<label for="name">Post Category <span>* </span></label>
		{!! Form::select('post_category_id',$data['post_category_options'],null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('post_category_id')}}</i></span> 
		@endif 
	</div>


	<div class="col-md-12 form-group">
		<label for="name">Summary <span></span></label>

		<textarea id="summary" name="summary" class="form-control" rows="2" placeholder="summary goes here..."></textarea>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('summary')}} </i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Description <span></span></label>

		<textarea id="editor" name="description" class="form-control" placeholder="description goes here..."></textarea>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('description')}} </i></span> 
		@endif 
	</div>
	

	<div class="col-md-12 form-group">
		<label for="name">Image </label>
		{!! Form::file('image',null,['id'=>'image','class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('image')}} </i></span> 
		@endif 
		<span class="text-default">
			<p>
				<i>Files must be less than <strong>5 MB.</strong></i> <br>
				<i>Allowed file types: <strong>png gif jpg jpeg.</strong></i> <br>
			</p>
		</span>		
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Attachment <span></span></label>
		{!! Form::file('attachment',null,['id'=>'attachment','class'=>'form-control']) !!}
		
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('attachment')}}</i></span> 
		@endif
		<span class="text-default">
			<p>
				<i>Files must be less than <strong>5 MB.</strong></i> <br>
				<i>Allowed file types: <strong>doc,docx,xls,xlsx,pdf.</strong></i> <br>
			</p>
		</span> 
	</div>
</fieldset>
<fieldset class="fieldset-border">

	<legend class="legend-border">Published on website</legend>
	<div class="col-md-6 form-group">
		<label for="name">Publish on website ? <span>*</span></label>
		{!! Form::select('status',$data['publish_options'],0,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
		@endif 
	</div>
	<div class="col-md-6 form-group">
		<label for="name">Publish date ? <span>*</span></label>
		{!! Form::text('date',null,['class'=>'form-control','id'=>'published_date']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('date')}}</i></span> 
		@endif 
	</div>
</fieldset>



