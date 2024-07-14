@extends('layouts.admin.app')

@section('title','Facility > View details')

@section('content')
<!-- Content Header (Facility header) -->
<section class="content-header">
	<h1> Details</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('facilities.index') }}">Teachers</a></li>
		<li class="active">Show</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('facilities.edit',[$facility->id])}}"><i class="fa fa-edit"></i></a>

				<a class="btn btn-sm btn-danger" href="{{ route('facilities.index')}}"><i class="fa fa-times"></i></a>

				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body">
			<fieldset class="fieldset-border">
				<legend class="legend-border">Details</legend>
				<div class="row">
					<div class="col-md-8">
						<div class="col-md-12">
							<h4 class="box-title">Title:</h4>
							<p>{{$facility->title}} </p>
						</div>
						<div class="col-md-12">
							<h4 class="box-title">Summary:</h4>
							<p>{{$facility->summary}} </p>
						</div>



						<div class="col-md-12">
							<h4 class="box-title">Image:</h4>
							<div class="photos">
								@forelse($facility->images as $img)
								<img class="img img-responsive" src="{{ asset('uploads/media/'.$img->image)}}">
								@empty
								<strong>No image</strong>
								@endforelse
							</div>
						</div>

						<div class="col-md-12">
							<h4 class="box-title">Attachment:</h4>
							@if($facility->attachment)
							<a href="{{ asset('uploads/facilities/'.$facility->attachment)}}" target="_blank"><i class="fa fa-eye"></i> view</a>
							@else
							<strong>No attachment</strong>
							@endif
						</div>
					</div>
					<div class="col-md-4">
						<div class="col-md-12">
							<h4 class="box-title">Description:</h4>
							<p>{!! $facility->description !!} </p>
						</div>
					</div>
			</fieldset>

			<fieldset class="fieldset-border">
				<legend class="legend-border">Website Options</legend>
				<div class="col-md-12">
					<div class="col-md-6">
						<p><strong> Display Order: </strong><label class="label label-success">{{$facility->order}}</label></p>
					</div>
					<div class="col-md-6">
						<p><strong>Publish status: </strong> {{ ($facility->status == 1) ? 'Publish' : 'Draft' }}</p>
					</div>
				</div>

			</fieldset>
		</div>
	</div>
	<!-- /.box -->
</section>
@endsection
