@extends('layouts.admin.app')

@section('title','Settings | Create')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="pull pull-right">
				<ul class="breadcrumb">
					<li> <a href="{{ route('dashboard') }}">Dashboard</a></li>
					<li> <a href="{{ route('wards.index') }}">Ward</a> </li>
					<li class="active">Create</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Create New Ward</h4>	
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('wards.store') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						@include('admin.setting.partial.form')
						<div class="form-inline">
							<div class="pull pull-right">
								<div class="form-group">
									<button class="btn btn-success pull-right" type="submit">Create</button>
								</div>
								<div class="form-group">
									<a class="btn btn-danger pull-right" href="{{ route('wards.index') }}">Cancel</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		@endsection