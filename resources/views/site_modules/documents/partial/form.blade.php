<fieldset class="fieldset-border">
	<legend class="legend-border">Document Details</legend>

	<div class="col-md-4 form-group">
		<label for="name">Aacademic Year <span>*</span></label>
		{!! Form::select('academic_year_id',$data['year_options'],$setting->academic_year_id,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('academic_year_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Document Type <span>*</span></label>
		{!! Form::select('document_type_id',$data['document_type_options'],null,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('document_type_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-4 form-group">
		<label for="name">Date <span>*</span></label>
		{!! Form::text('date',null,['class'=>'form-control','id'=>'date']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('date')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Title <span>* </span></label>
		{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Document Title']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('title')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Summary </label>

		<textarea id="summary" name="summary" class="form-control" rows="2" placeholder="summary goes here..."></textarea>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('summary')}} </i></span> 
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
	<legend class="legend-border">Website Display Options</legend>
	<div class="row col-md-12">
		<div class="col-md-6 form-group">
			<label for="name">Display Order <span>*</span></label>
			{!! Form::number('order',0,['class'=>'form-control']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('order')}}</i></span> 
			@endif 
		</div>
	</div>
	<div class="row col-md-12">
		<div class="col-md-6 form-group">
			<label for="name">Publish on website ? <span>*</span></label>
			{!! Form::select('status',$data['publish_options'],0,['class'=>'form-control']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
			@endif 
		</div>
	</div>
</fieldset>



