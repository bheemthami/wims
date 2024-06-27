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
		<label for="name">Link <span>* </span></label>
		{!! Form::text('link',null,['class'=>'form-control','placeholder'=>'https://www.example.com/']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('link')}}</i></span> 
		@endif 
	</div>

</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Website Display Options</legend>
	<div class="row col-md-12">
		<div class="col-md-4 form-group">
			<label for="name">Display Section <span>*</span></label>
			{!! Form::select('type',$data['type_options'],'footer',['class'=>'form-control']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('type')}}</i></span> 
			@endif 
		</div>
	</div>
	<div class="row col-md-12">
		<div class="col-md-4 form-group">
			<label for="name">Display Order <span>*</span></label>
			{!! Form::number('order',null,['class'=>'form-control']) !!}
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



