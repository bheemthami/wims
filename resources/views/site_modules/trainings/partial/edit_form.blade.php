<fieldset class="fieldset-border">
	<legend class="legend-border">Details</legend>

	<div class="col-md-12 form-group">
		<label for="name">Title <span>* </span></label>
		{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('title')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Training Category <span>*</span></label>
		{!! Form::select('training_category_id',$data['training_category_options'],$training->training_category_id,['class'=>'form-control']) !!}
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('training_category_id')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Training Type <span>*</span></label>
		{!! Form::select('training_type_id',$data['training_type_options'],$training->training_type_id,['class'=>'form-control']) !!}
		@if($errors)   
		<span class="text-danger"><i>{{$errors->first('training_type_id')}}</i></span> 
		@endif 
	</div>


	<div class="col-md-3 form-group">
		<label for="name">Quota <span>* </span></label>
		{!! Form::text('quota',null,['class'=>'form-control','placeholder'=>' quota']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('quota')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-3 form-group">
		<label for="name">Duration <span>* </span></label>
		{!! Form::text('duration',null,['class'=>'form-control','placeholder'=>'duration']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('duration')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Eligibility <span>* </span></label>
		{!! Form::text('eligibility',null,['class'=>'form-control','placeholder'=>'eligibility']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('eligibility')}}</i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Summary</label>

		<textarea id="summary" name="summary" class="form-control" rows="2" placeholder="summary goes here..."></textarea>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('summary')}} </i></span> 
		@endif 
	</div>

	<div class="col-md-12 form-group">
		<label for="name">Description <span>*</span></label>

		<textarea id="editor" name="description" class="form-control" placeholder="description goes here..."> {{ $training->description }}</textarea>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('description')}} </i></span> 
		@endif 
	</div>
	

	<div class="col-md-12 form-group">
		@if($training->image)
		<img src="{{ asset('uploads/trainings/'.$training->image)}}" width="100px">
		@else
		<span class="text-danger"> No Attachment</span>
		@endif
		<br>
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
		@if($training->attachment)
		<img src="{{ asset('uploads/trainings/'.$training->attachment)}}" width="100px">
		@else
		<span class="text-danger"> No Image</span>
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
		{!! Form::select('status',$data['publish_options'],$training->status,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
		@endif 
	</div>
</fieldset>



