<fieldset class="fieldset-border">
	<legend class="legend-border">Details</legend>

	<div class="col-md-12 form-group">
		<label for="name">Statement By <span>* </span></label>
		{!! Form::text('statement_by',null,['class'=>'form-control','placeholder'=>'name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('statement_by')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Recognition <span>* </span></label>
		{!! Form::text('recognition',null,['class'=>'form-control','placeholder'=>'recognition']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('recognition')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Statement <span>*</span></label>

		<textarea id="statement" name="statement" class="form-control" rows="2" placeholder="statement goes here...">{{ $testimonial->statement}}</textarea>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('statement')}} </i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		@if($testimonial->image)
		<img src="{{ asset('uploads/testimonials/'.$testimonial->image)}}" width="100px">
		@else
		<span class="text-danger"> No Image</span>
		@endif
		<label for="name">Image</label>
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
		<label for="name">Remarks </label>
		{!! Form::text('remarks',null,['class'=>'form-control','placeholder'=>'name']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('remarks')}}</i></span> 
		@endif 
	</div>


</fieldset>

<fieldset class="fieldset-border">
	<legend class="legend-border">Website Display Options</legend>
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
			{!! Form::select('status',$data['publish_options'],$testimonial->status,['class'=>'form-control']) !!}
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
			@endif 
		</div>
	</div>
</fieldset>
