@extends('layouts.admin.app')

@section('title') Change Password @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Change Password</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Change Password Form</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Create</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<form method="POST" action="{{ route('change_password.store') }}">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="name">Enter old password<span>*</span></label>
						<input id="password" type="password" class="form-control" name="old_password" placeholder="old password" autocomplete="false">
						@if($errors)
						<span class="text-danger"><i>{{$errors->first('old_password')}}</i></span>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						<label for="name">New Password<span>*</span></label>
						<input id="password" type="password" class="form-control" name="password" placeholder="new password" autocomplete="false">
						@if($errors)
						<span class="text-danger"><i>{{$errors->first('password')}}</i></span>
						@endif
						<span class="text-success">
							<ul class="nav-bar">
								<li>Minimum eight characters</li>
								<li>at least one uppercase letter</li>
								<li>one lowercase letter</li>
								<li>one number and one special character</li>
							</ul>
						</span>

					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						<label for="name">Confirm Password<span>*</span></label>
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm password" autocomplete="false">
						<span id="confirm-message" class="text-success">
						</span>
						@if($errors)
						<span class="text-danger"><i>{{$errors->first('password_confirmation')}}</i></span>
						@endif
					</div>
				</div>
				<div class="form-inline">
					<div class="pull pull-right">
						<div class="form-group">
							<button class="btn btn-success pull-right" type="submit">Submit</button>
						</div>
						<div class="form-group">
							<a class="btn btn-danger pull-right" href="{{ route('dashboard') }}">Cancel</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>


<script type="text/javascript">


</script>
@endsection
