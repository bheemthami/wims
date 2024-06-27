@extends('layouts.admin.app')

@section('title','Gallery | details')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Details</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('galleries.index') }}">Gallery</a></li>
		<li class="active">Show</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('galleries.edit',[$gallery->id])}}"><i class="fa fa-edit"></i></a>

				<a class="btn btn-sm btn-danger" href="{{ route('galleries.index')}}"><i class="fa fa-times"></i></a>

				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		
		<div class="box-body">
			<fieldset class="fieldset-border">
				<legend class="legend-border">details</legend>

				<div class="mb-3 col-md-12">
					<label for="year" class="col-sm-2 col-form-label">Year</label>
					<div class="col-sm-10">
						<p>{{$gallery->academicYear->year}} </p>
					</div>
				</div>

				<div class="mb-3 col-md-12">
					<label for="year" class="col-sm-2 col-form-label">Type</label>
					<div class="col-sm-10">
						<p>{{strtoupper($gallery->type)}} </p>
					</div>
				</div>

				<div class="mb-3 col-md-12">
					<label for="title" class="col-sm-2 col-form-label">Title</label>
					<div class="col-sm-10">
						<p>{{$gallery->title}} </p>
					</div>
				</div>

				<div class="mb-3 col-md-12">
					<label for="title" class="col-sm-2 col-form-label">Is shown in slider</label>
					<div class="col-sm-10">
						<p>{{$gallery->is_slider ? 'YES' : 'NO'}} </p>
					</div>
				</div>


				@if($gallery->type === 'image')
				<div class="mb-3 col-md-12">
					<label for="title" class="col-sm-2 col-form-label">Image</label>
					<div class="col-sm-10">
						<table class="table table-bordered table-striped">
							<thead>
								<th>S.N.</th>
								<th>Image</th>
								<th>Image</th>
								<th>Order</th>
								<th>Action</th>
							</thead>
							<tbody>
								@forelse($gallery->images as $key=>$img)
								<tr>
									<td>{{ ++$key }}</td>
									<td>
										<input type="hidden" name="old_images[id]" value="{{ $img->id }}" class="form-control">
										<img src="{{asset('uploads/galleries/'.$img->image)}}" width="80px" alt="No image">
									</td>
									<td>
										{{ $img->title ? $img->title : '-' }}
									</td>
									<td>
										{{ $img->order }}
									</td>							
									<td>
										<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$img->id}}" data-route="{{route('image-galleries.destroy', $img->id) }}"> <i class="fa fa-trash"></i></a>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="8"> Not found!!!</td>
								</tr>
								@endforelse

							</tbody>
						</table>
					</div>
				</div>
				@else
				<div class="mb-3 col-md-12">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/{{$gallery->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				</div>
				@endif

			</fieldset>

			<fieldset class="fieldset-border">
				<legend class="legend-border">Website Options</legend>
				<div class="mb-3 col-md-12">
					<div class="col-md-6">
						<p><strong> Published date: </strong><label class="label label-info">{{$gallery->date}}</label></p>
					</div>
					<div class="col-md-6">
						<p><strong>Publish status: </strong> <label for="" class="label label-{{$gallery->status?'success':'warning'}}"> {{ ($gallery->status == 1) ? 'Publish' : 'Draft' }} </label></p>	
					</div>
				</div>

			</fieldset>
		</div>
	</div>
	<!-- /.box -->
</section>
@endsection