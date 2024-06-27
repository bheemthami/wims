<fieldset class="fieldset-border">
	<legend class="legend-border">Banner Details</legend>

	<div class="col-md-12 form-group">
		<label for="name">Title <span>* </span></label>
		{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('title')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Tagline </label>
		{!! Form::text('tagline',null,['class'=>'form-control','placeholder'=>'tagline']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('tagline')}}</i></span> 
		@endif 
	</div>


	<div class="col-md-12 form-group">
		<label for="name">Image <span>* </span></label>
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

</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Website Display Options</legend>
	<div class="row col-md-12">
		<div class="col-md-4 form-group">
			<label for="name">Display Order <span>*</span></label>
			{!! Form::number('order',0,['class'=>'form-control']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('order')}}</i></span> 
			@endif 
		</div>
	</div>
	<div class="row col-md-12">
		<div class="col-md-4 form-group">
			<label for="name">Publish on website ? <span>*</span></label>
			{!! Form::select('status',$data['publish_options'],0,['class'=>'form-control']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
			@endif 
		</div>
	</div>
</fieldset>



