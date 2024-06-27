
<div class="row">
	<div class="col-md-12 form-group">
		<label for="name">Title <span>* </span></label>
		{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title of the event']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('title')}}</i></span> 
		@endif 
	</div>
</div>

<div class="row">
	<div class='col-md-6'>
		<label for="name">Start Date<span>*</span></label>
		<div class="form-group">
			<div class='input-group date' id='start_date'>
				{!! Form::dateTime('start_date',null,['class'=>'form-control','id'=>'start_date']) !!}
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('start_date')}} </i></span> 
			@endif 
		</div>
	</div>

	<div class='col-md-6'>
		<!-- time Picker -->
		<div class="bootstrap-timepicker">
			<div class="form-group">
				<label>Start Time <span>*</span></label>

				<div class="input-group">
					<input type="text" class="form-control timepicker" name="start_time" id="start_time">

					<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
					
				</div>
				<!-- /.input group -->
			</div>
			<!-- /.form group -->
		</div>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('start_time')}} </i></span> 
		@endif
	</div>
</div>

<div class="row">
	<div class='col-md-6'>
		<label for="name">End Date<span>*</span></label>
		<div class="form-group">
			<div class='input-group date' id='end_date'>
				{!! Form::dateTime('end_date',null,['class'=>'form-control','id'=>'end_date']) !!}
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
			@if($errors)      
			<span class="text-danger"><i>{{$errors->first('end_date')}} </i></span> 
			@endif 
		</div>
	</div>

	<div class='col-md-6'>
		<!-- time Picker -->
		<div class="bootstrap-timepicker">
			<div class="form-group">
				<label>End Time <span>*</span></label>

				<div class="input-group">
					<input type="text" class="form-control timepicker" name="end_time" id="end_time">

					<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
				</div>
				<!-- /.input group -->
			</div>
			<!-- /.form group -->
		</div>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('end_time')}} </i></span> 
		@endif 
	</div>
</div>

<div class="row">
	<div class="col-md-12 form-group">
		<label for="name">Description <span>*</span></label>

		<textarea id="editor" name="description" class="form-control" placeholder="description goes here...">{{ $event->description }}</textarea>
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('description')}} </i></span> 
		@endif 
	</div>
</div>

<div class="row">
	<div class="col-md-12 form-group">
		@if($event->image)
		<img src="{{ asset('uploads/events/'.$event->image)}}" width="100px">
		@else
		<span class="text-danger"> No Image</span>
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
</div>

<div class="row">
	<div class="col-md-12 form-group">
		@if($event->attachment)
		<a href ="{{ asset('uploads/events/'.$event->attachment)}}"> <i class="fa fa-file"> view </i> </a>
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
</div>

<div class="row">
	<div class="col-md-2 form-group">
		<label for="name">Publish on website ? <span>*</span></label>
		{!! Form::select('status',$data['publish_options'],$event->status,['class'=>'form-control']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('status')}}</i></span> 
		@endif 
	</div>
	<div class="col-md-5 form-group">
		<label for="name">Remarks <span>(Optional)</span></label>
		{!! Form::text('remarks',null,['class'=>'form-control','placeholder'=>'any other details']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('remarks')}}</i></span> 
		@endif 
	</div>
	<div class="col-md-5 form-group">
		<label for="name">Speacker of the event<span>(Optional)</span></label>
		{!! Form::text('speaker',null,['class'=>'form-control','placeholder'=>'Speaker of the event']) !!}
		@if($errors)      
		<span class="text-danger"><i>{{$errors->first('speaker')}}</i></span> 
		@endif 
	</div>
</div>


