@extends('layouts.app')

@section('title',"Welcome")

@section('content')

<section class="content">
	<div class="container first-border">
		<div class="row">
			<div class="main-wrapper">
				<div class="header-row">
					<div class="col-md-12 flex"> 
						<div>
							<a href="{{route('welcome')}}">
								<img class="img img-responsive logo" src="{{ asset('uploads/setting/'.$settings->logo) }}">
							</a>
						</div>
						<div class="office-wrapper">
							<div class="header-office">{{ $settings->office}}</div>
							<div class="header-address">{{$settings->office_address}}</div>
							<div class="contact-address">
								Phone:- {{$settings->phone}}, Email:- {{$settings->email}}
							</div>
							<div class="portal"> <span>{{$settings->system_name}}</span></div>
						</div>
						<div>
							<img class="img img-responsive flag" src="{{ asset('uploads/setting/local_logo.gif') }}">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<a class="btn btn-sm btn-primary" href="{{ route('result.search') }}"> <i class="fa fa-eye"></i> View progress report</a>
					<a class="btn btn-sm btn-primary" href="{{ route('login') }}"> <i class="fa fa-user"></i> User Login</a>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection