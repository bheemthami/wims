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
		<label for="name">Summary <span></span></label>

		<textarea id="summary" name="summary" class="form-control" rows="2" placeholder="summary goes here..."></textarea>
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('summary')}} </i></span>
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
		<label for="name">Type <span>* </span></label>
		{!! Form::text('type',$gallery->type,['id'=>'gallery_type','class'=>'form-control', 'readOnly'=>true]) !!}
		@if($errors)
		<span class="text-danger"><i>{{$errors->first('type')}}</i></span>
		@endif
	</div>


	@if($gallery->type === 'image')
	<div class="image-container">
		<div class="col-md-12 form-group">
			<table class="table table-bordered table-striped">
				<thead>
					<th>Image</th>
					<th>Image</th>
					<th>Order</th>
				</thead>
				<tbody>
					@forelse($gallery->images as $img)
					<tr>
						<td>
							<input type="hidden" name="old_images[{{ $img->id}}][id]" value="{{ $img->id }}" class="form-control">
							<img src="{{asset('uploads/galleries/'.$img->image)}}" width="80px" alt="No image">
						</td>
						<td>
							<input type="text" name="old_images[{{ $img->id}}][title]" value="{{ $img->title }}" class="form-control">
						</td>
						<td>
							<input type="number" name="old_images[{{ $img->id}}][order]" value="{{ $img->order }}" class="form-control">
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="8"> Not found!!!</td>
					</tr>
					@endforelse

				</tbody>
			</table>

			<br>
			<label for="name">Image </label>
			{!! Form::file('image[]',['id'=>'image','multiple'=>'true']) !!}
			@if($errors)
			<span class="text-danger"><i>{{$errors->first('image')}} </i></span>
			@endif
			<span class="text-default">
				<p>
					<i>Files must be less than <strong>10 MB.</strong></i> <br>
					<i>Allowed file types: <strong>png gif jpg jpeg.</strong></i> <br>
				</p>
			</span>
		</div>
		<div class="row col-md-12">
			<div class="col-md-6 form-group">
				{!! Form::checkbox('is_slider',$gallery->is_slider,($gallery->is_slider == 1) ? 'true' : 'false' ) !!}
				@if($errors)
				<span class="text-danger"><i>{{$errors->first('is_slider')}}</i></span>
				@endif
				<label for="name">Show on slider </label>
			</div>
		</div>
	</div>
	@else
	<div class="row col-md-12">
		<div class="col-md-6 form-group">
			<label for="name">Youtube video ID <span>* </span></label>
			{!! Form::text('link',null,['class'=>'form-control','placeholder'=>'Title']) !!}
			@if($errors)
			<span class="text-danger"><i>{{$errors->first('link')}}</i></span>
			@endif
		</div>
	</div>
	@endif

</fieldset>
<fieldset class="fieldset-border">
	<legend class="legend-border">Published on website</legend>
	<div class="row col-md-12">
		<div class="col-md-6 form-group">
			<label for="name">Publish on website ? <span>*</span></label>
			{!! Form::select('status',$data['publish_options'],$gallery->status,['class'=>'form-control']) !!}
			@if($errors)
			<span class="text-danger"><i>{{$errors->first('status')}}</i></span>
			@endif
		</div>
	</div>
	<div class="row col-md-12">
		<div class="col-md-6 form-group">
			<label for="name">Publish date ? <span>*</span></label>
			{!! Form::text('date',null,['class'=>'form-control','id'=>'published_date']) !!}
			@if($errors)
			<span class="text-danger"><i>{{$errors->first('date')}}</i></span>
			@endif
		</div>
	</div>
</fieldset>
