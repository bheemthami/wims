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
		<label for="name">Summary (Max 400 characters) <span>*</span></label>

		<textarea id="summary" name="summary" class="form-control" rows="2" placeholder="summary goes here..."></textarea>
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('summary')}} </i></span>
		@endif
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Description (Max 10000 characters)<span>*</span></label>
		<textarea id="editor" name="description" class="form-control" placeholder="description goes here..."></textarea>
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('description')}} </i></span>
		@endif
	</div>


	<div class="col-md-12 form-group">
		<label for="name">Images <span>*</span> </label>
		{!! Form::file('image[]',['id'=>'image','multiple'=>'true']) !!}
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('image.*')}} </i></span>
		@endif
		<span class="text-default">
			<p class="mt-10">
				<i>Files must be less than <strong>10 MB.</strong></i> <br>
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
	<div class="col-md-6 form-group">
		<label for="name">Display Order <span>*</span></label>
		{!! Form::number('order',null,['class'=>'form-control']) !!}
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('order')}}</i></span>
		@endif
	</div>

	<div class="col-md-6 form-group">
		<label for="name">Publish on website ? <span>*</span></label>
		{!! Form::select('status',$data['publish_options'],1,['class'=>'form-control']) !!}
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('status')}}</i></span>
		@endif
	</div>
</fieldset>
