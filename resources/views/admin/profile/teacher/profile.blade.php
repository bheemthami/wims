@extends('layouts.admin.app')

@section('title','Prfoile details')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Details</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('teachers.index') }}">Teachers</a></li>
		<li class="active">Show</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('profile.edit',[$profile->id])}}"><i class="fa fa-edit"></i> Edit Profile</a>

				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		
		<div class="box-body">
			<fieldset class="fieldset-border">
				<legend class="legend-border">Office details</legend>
				<div class="col-md-12">
					<div class="col-md-4">
						<p><strong> Designation: </strong><label class="label label-success">{{$profile->designation->name}} </p>
						</div>
						<div class="col-md-4">
							<p><strong>Joining date: </strong> {{ $profile->joining_date }}</p>	
						</div>
						<div class="col-md-4">
							<p><strong> Leaving date: </strong>  {{ $profile->leaving_date  }}</p>	
						</div>
					</div>

					<div class="col-md-12">
						<h3>User login details</h3>
						<div class="col-md-4">
							<p><strong>Username/Email: </strong> {{ $user->email}}</p>
						</div>
						<div class="col-md-4">
							<p><strong>Password: </strong> ******** </p>	
						</div>
						<div class="col-md-4">
							<p><strong>Created at: </strong> {{ date('F j, Y h:i A',strtotime($user->created_at)) }} </p>	
						</div>
					</div>

				</fieldset>

				<fieldset class="fieldset-border">
					<legend class="legend-border">Personal Details</legend>
					<div class="col-md-12">
						<div class="col-md-4">
							<p><strong> Name: </strong><label class="label label-success">{{$profile->first_name}} {{$profile->middle_name}} {{$profile->last_name}}</label> <span class="badge">{{ $profile->status ? 'Active' : 'Inactive'}}</span></p>
						</div>
						<div class="col-md-4">
							<p><strong>DOB: </strong> {{ $profile->dob }}</p>	
						</div>
						<div class="col-md-4">
							<p><strong> Gender: </strong>  {{ $profile->gender }}</p>	
						</div>
					</div>

					<div class="col-md-12">
						<div class="col-md-4">
							<p><strong> Address: </strong>{{ $profile->municipality }} {{ $profile->localLevelType->type_name }} - {{$profile->ward_no}}, {{$profile->district}}</p>
						</div>
						<div class="col-md-4">
							<p><strong>Mobile: </strong> {{ $profile->mobile }}</p>	
						</div>
						<div class="col-md-4">
							<p><strong> Email: </strong>  {{ $profile->email }}</p>	
						</div>
					</div>

				</fieldset>

				<fieldset class="fieldset-border">
					<legend class="legend-border">Academic Details</legend>
					<div class="col-md-12">
						<div class="col-md-4">
							<p><strong> Degree: </strong><label class="label label-success">{{$profile->degree}} [{{ $profile->status ? 'Completed'  : 'running'}}]</label></p>
						</div>
						<div class="col-md-4">
							<p><strong>Major Subject: </strong> {{ $profile->major_subject }}</p>	
						</div>
						<div class="col-md-4">
							<p><strong> Completed in: </strong>  {{ $profile->completed_year }}</p>	
						</div>
					</div>

					<div class="col-md-12">
						<div class="col-md-4">
							<p><strong> Address: </strong>{{ $profile->municipality }} {{ $profile->localLevelType->type_name }} - {{$profile->ward_no}}, {{$profile->district}}</p>
						</div>
						<div class="col-md-4">
							<p><strong>Mobile: </strong> {{ $profile->mobile }}</p>	
						</div>
						<div class="col-md-4">
							<p><strong> Email: </strong>  {{ $profile->email }}</p>	
						</div>
					</div>

				</fieldset>
			</div>
		</div>
		<!-- /.box -->
	</section>
	@endsection