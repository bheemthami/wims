@extends('layouts.admin.app')

@section('title','Program > View details')

@section('content')
<!-- Content Header (Program header) -->
<section class="content-header">
	<h1> Details</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('programs.index') }}">Programs</a></li>
		<li class="active">Show</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('programs.edit',[$program->id])}}"><i class="fa fa-edit"></i></a>

				<a class="btn btn-sm btn-danger" href="{{ route('programs.index')}}"><i class="fa fa-times"></i></a>

				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		
		<div class="box-body">
			<fieldset class="fieldset-border">
				<legend class="legend-border">details</legend>
				<div class="col-md-12">
					<h4 class="box-title">Title:</h4>
					<p>{{$program->title}} </p>
				</div>

				<div class="col-md-6">
					<h4 class="box-title">Quota:</h4>
					<p>{{$program->quota}} </p>
				</div>


				<div class="col-md-6">
					<h4 class="box-title">Duration:</h4>
					<p>{{$program->duration}} </p>
				</div>


				<div class="col-md-6">
					<h4 class="box-title">Eligibility:</h4>
					<p>{{$program->eligibility}} </p>
				</div>

				<div class="col-md-12">
					<h4 class="box-title">Summary:</h4>
					<p>{{$program->summary}} </p>
				</div>


				<div class="col-md-12">
					<h4 class="box-title">Body:</h4>
					<p>{!! $program->description !!} </p>
				</div>

				<div class="col-md-12">
					<h4 class="box-title">Image:</h4>
					@if($program->image)
					<img src="{{ asset('uploads/programs/'.$program->image)}}" width="200px">
					@else
					<strong>No image</strong>
					@endif
				</div>

				<div class="col-md-12">
					<h4 class="box-title">Attachment:</h4>
					@if($program->attachment)
					<a href ="{{ asset('uploads/programs/'.$program->attachment)}}" target="_blank"><i class="fa fa-eye"></i> view</a>
					@else
					<strong>No attachment</strong>
					@endif
				</div>

			</fieldset>

			<fieldset class="fieldset-border">
				<legend class="legend-border">Website Options</legend>
				<div class="col-md-12">
					<div class="col-md-6">
						<p><strong> Display Order: </strong><label class="label label-success">{{$program->order}}</label></p>
					</div>
					<div class="col-md-6">
						<p><strong>Publish status: </strong> {{ ($program->status == 1) ? 'Publish' : 'Draft' }}</p>	
					</div>
				</div>

			</fieldset>
		</div>
	</div>
	<!-- /.box -->
</section>
@endsection