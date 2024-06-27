@extends('layouts.admin.app')

@section('title','Official > Create')

@section('content')
<!-- Content Header (Official header) -->
<section class="content-header">
	<h1> Officials</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('officials.index') }}"> Officials</a></li>
		<li class="active">Create</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Create</h3>
			<div class="box-tools pull-right">
				<label class="labellabel-danger">Fields with * are compulsory.</label>
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<form id="official-form" method="POST" action="{{ route('officials.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				@include('site_modules.officials.partial.form')
				<div class="form-inline">
					<div class="pull pull-right">
						<div class="form-group">
							<button class="btn btn-success pull-right" type="submit">Submit</button>
						</div>
						<div class="form-group">
							<a class="btn btn-danger pull-right" href="{{ route('officials.index') }}">Cancel</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<script>
	$(document).ready(function(){
		$('#bs_dob').nepaliDatePicker();
		$('#joining_date').nepaliDatePicker();
		$('#leaving_date').nepaliDatePicker();
	});
</script>
@endsection