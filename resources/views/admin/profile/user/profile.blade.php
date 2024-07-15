@extends('layouts.admin.app')

@section('title','Profile details')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Details</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Show</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Profile details</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('profile.edit',$profile->id)}}"><i class="fa fa-edit"></i>Edit Profile</a>

				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body">


			<div class="row">
				<div class="col-md-6">
					<p><strong>Name: </strong> {{ $profile->first_name}} {{ $profile->last_name}}</p>
				</div>


				<div class="col-md-6">
					<p><strong>Username/Email: </strong> {{ $profile->email}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<p><strong>Password: </strong> ******** </p>
				</div>

				<div class="col-md-6">
					<p><strong>Created at: </strong> {{ date('F j, Y h:i A',strtotime($profile->created_at)) }} </p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<p><strong>Updated at: </strong> {{ date('F j, Y h:i A',strtotime($profile->updated_at)) }} </p>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box -->
</section>
@endsection
