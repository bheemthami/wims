<fieldset class="fieldset-border">
	<legend class="legend-border">Details</legend>

	<div class="col-md-12 form-group">
		<label for="name">Type <span>* </span></label>
		{!! Form::select('type',$data['type_options'],$embed->type,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('type')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Title </label>
		{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('title')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">iFrame  <span>* </span></label>
		{!! Form::textarea('iframe',null,['class'=>'form-control','placeholder'=>'iframe']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('iframe')}}</i></span> 
		@endif 
	</div>

</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Website Display Options</legend>
	<div class="row col-md-12">
		<div class="col-md-4 form-group">
			<label for="name">Publish on website ? <span>*</span></label>
			{!! Form::select('status',$data['publish_options'],$embed->status,['class'=>'form-control']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
			@endif 
		</div>
	</div>
</fieldset>



