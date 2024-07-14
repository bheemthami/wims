<fieldset class="fieldset-border">
	<legend class="legend-border">Page Details</legend>

	<div class="col-md-12 form-group">
		<label for="name">Title <span>* </span></label>
		{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Page Title']) !!}
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('title')}}</i></span>
		@endif
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Summary <span>*</span></label>

		<input id="summary" type="textarea" class="form-control" placeholder="summary goes here..." name="summary" value="{{ $facility->summary }}">
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('summary')}} </i></span>
		@endif
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Description <span>*</span></label>

		<textarea id="editor" name="description" class="form-control" placeholder="description goes here...">{!! $facility->description !!} </textarea>

		@if($errors)
		<span class="text-danger"><i>{{$errors->first('description')}} </i></span>
		@endif
	</div>


	<div class="col-md-6 form-group">
		<label for="name">Image </label>
		{!! Form::file('image[]',['id'=>'image','multiple'=>'true']) !!}
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

	<div class="col-md-6 form-group">
		<label for="name">Uploaded Images </label>
		<div class="photos">
			@forelse($facility->images as $img)
			<img class="img img-responsive" src="{{ asset('uploads/media/'.$img->image)}}">
			@empty
			<span class="text-danger"> No Images</span>
			@endforelse
		</div>
	</div>

	<div class="col-md-12 form-group">

		@if($facility->attachment)
		<a href="{{ asset('uploads/facilities/'.$facility->attachment)}}"> <i class="fa fa-file"> view </i> </a>
		@else
		<span class="text-danger"> No Attachment</span>
		@endif
		<br>

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
		{!! Form::select('status',$data['publish_options'],$facility->status,['class'=>'form-control']) !!}
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('status')}}</i></span>
		@endif
	</div>
</fieldset>
