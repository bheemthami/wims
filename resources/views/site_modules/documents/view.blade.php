@extends('layouts.admin.app')

@section('title','Document > View details')

@section('content')
<!-- Content Header (Document header) -->
<section class="content-header">
	<h1> Details</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('documents.index') }}">Documents</a></li>
		<li class="active">Show</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('documents.edit',[$document->id])}}"><i class="fa fa-edit"></i></a>

				<a class="btn btn-sm btn-danger" href="{{ route('documents.index')}}"><i class="fa fa-times"></i></a>

				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		
		<div class="box-body">
			<fieldset class="fieldset-border">
				<legend class="legend-border">details</legend>

				<div class="col-md-6">
					<h4 class="box-title"><strong> Academic Year: </strong></h4>
					<p>{{$document->academicYear->year}} </p>
				</div>

				<div class="col-md-6">
					<h4 class="box-title"><strong> Document Type: </strong></h4>
					<p>{{$document->documentType->title}} </p>
				</div>

				<div class="col-md-12">
					<h4 class="box-title"><strong> Title: </strong></h4>
					<p>{{$document->title}} </p>
				</div>
				<div class="col-md-12">
					<h4 class="box-title"><strong> Summary: </strong></h4>
					<p>{{$document->summary ? $document->summary : '-' }} </p>
				</div>


				<div class="col-md-12">
					<h4 class="box-title"><strong> Image: </strong></h4>
					@if($document->image)
					<img src="{{ asset('uploads/documents/'.$document->image)}}" width="200px">
					@else
					<strong>No image</strong>
					@endif
				</div>

				<div class="col-md-12">
					<h4 class="box-title"><strong> Attachment: </strong></h4>
					@if($document->attachment)
					<a class="btn btn-sm btn-success" href ="{{ asset('uploads/documents/'.$document->attachment)}}" target="_blank"><i class="fa fa-eye"></i> view</a>
					@else
					<strong>No attachment</strong>
					@endif
				</div>

			</fieldset>

			<fieldset class="fieldset-border">
				<legend class="legend-border">Website Options</legend>
				<div class="col-md-12">
					<div class="col-md-4">
						<p><strong> Display Order: </strong><label class="label label-success">{{$document->order}}</label></p>
					</div>
					<div class="col-md-4">
						<p><strong> Date : </strong><label class="label label-success">{{$document->date}}</label></p>
					</div>
					<div class="col-md-4">
						<p><strong>Publish status: </strong>  <label class="label label-{{ $document->status ? 'success' : 'warning' }}">{{ $document->status ? 'Publish' : 'Draft' }} </label></p>	
					</div>
				</div>

			</fieldset>
		</div>
	</div>
	<!-- /.box -->
</section>
@endsection