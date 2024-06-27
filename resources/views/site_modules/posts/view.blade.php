@extends('layouts.admin.app')

@section('title','Post > View details')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Details</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('posts.index') }}">Post</a></li>
		<li class="active">Show</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('posts.edit',[$post->id])}}"><i class="fa fa-edit"></i></a>

				<a class="btn btn-sm btn-danger" href="{{ route('posts.index')}}"><i class="fa fa-times"></i></a>

				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		
		<div class="box-body">
			<fieldset class="fieldset-border">
				<legend class="legend-border">details</legend>
				<div class="col-md-6">
					<div class="mb-3 col-md-12">
						<label for="year" class="col-sm-2 col-form-label">Year</label>
						<div class="col-sm-10">
							<p>{{$post->academicYear->year}} </p>
						</div>
					</div>

					<div class="mb-3 col-md-12">
						<label for="year" class="col-sm-2 col-form-label">Category</label>
						<div class="col-sm-10">
							<p>{{$post->postCategory->title}} </p>
						</div>
					</div>

					<div class="mb-3 col-md-12">
						<label for="title" class="col-sm-2 col-form-label">Title</label>
						<div class="col-sm-10">
							<p>{{$post->title}} </p>
						</div>
					</div>

					<div class="mb-3 col-md-12">
						<label for="title" class="col-sm-2 col-form-label">Summary</label>
						<div class="col-sm-10">
							<p>{{$post->summary ? $post->summary : ' - ' }} </p>
						</div>
					</div>

					<div class="mb-3 col-md-12">
						<label for="title" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
							<p>{{ $post->description ? $post->description : ' - ' }} </p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3 col-md-12">
						@if($post->image)
						<img class="img img-responsive" src="{{ asset('uploads/posts/'.$post->image)}}">
						@else
						<strong>No image</strong>
						@endif
					</div>

					<div class="mb-3 col-md-12">
						@if($post->attachment)
						<a href ="{{ asset('uploads/posts/'.$post->attachment)}}" target="_blank"><i class="fa fa-eye"></i> view</a>
						@else
						<strong>No attachment</strong>
						@endif
					</div>
				</div>

			</fieldset>

			<fieldset class="fieldset-border">
				<legend class="legend-border">Website Options</legend>
				<div class="mb-3 col-md-12">
					<div class="col-md-6">
						<p><strong> Published date: </strong><label class="label label-info">{{$post->date}}</label></p>
					</div>
					<div class="col-md-6">
						<p><strong>Publish status: </strong> <label for="" class="label label-{{$post->status?'success':'warning'}}"> {{ ($post->status == 1) ? 'Publish' : 'Draft' }} </label></p>	
					</div>
				</div>

			</fieldset>
		</div>
	</div>
	<!-- /.box -->
</section>
@endsection