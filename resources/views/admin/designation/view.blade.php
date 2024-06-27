@extends('layouts.admin.app')

@section('title','Academic Year > View')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="pull pull-left">
				<ul class="breadcrumb">
					<li> <a href="{{ route('dashboard') }}">Dashboard</a></li>
					<li class="active">Wards</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"> 
					<div class="form-inline">
						<div class="pull pull-left">
							<h4>{{ ucfirst($ward->name) }}</h4>
						</div>	
						<div class="pull pull-right">
							<div class="form-group">
								<a class="btn btn-primary btn-sm form-control" href="{{route('schools.create')}}?w={{$ward->id}}"> <i class="fa fa-plus"></i> Add School</a>
								<!-- <a class="btn btn-info btn-sm form-control" href="{{route('wards.edit',$ward->id)}}"> <i class="fa fa-edit"></i></a>
								<a class="btn btn-danger btn-sm form-control" href="{{route('wards.destroy',$ward->id)}}"> <i class="fa fa-trash"></i></a> -->
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">
					di
				</div>
				<div class="panel-footer">
					<div class="form-inline">
						<div class="pull pull-left">
							<div class="form-group">
								<input type="text" name="Name" class="search-params form-control" >
							</div>
							
							<div class="form-group">
								<button class="btn btn-default form-control"> <i class="fa fa-search"></i> Search School</button>
							</div>
						</div>

						<div class="pull pull-right">
							<div class="form-group">
								<select id ="perPage" name="default" class="form-control">
									<option value="10" selected="">10</option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<option value="0">All</option>
								</select>
							</div>
						</div>
					</div>
					<div id="replaceTable" class="list">
						<table class="table table-responsive table-bordered table-striped">
							<thead>
								<th>S.No.</th>
								<th>Name</th>
								<th>Image</th>
								<th>Actions</th>
							</thead>
							<tbody>
								@php $sno = 1*$schools->currentPage(); @endphp
								@forelse($schools as $school)
								<tr>	
									<td>{{ $sno++ }}</td>
									<td> <a href="{{route('schools.index') }}?w={{ $school->id }}">{{ ucfirst($school->name) }} </a></td>
									<td>
										<img src="{{ asset('uploads/school').'/'.$school->image }}" width="70" height="70" alt="Image Not Found">
									</td>
									<td>
										<button class="btn btn-primary"><i class="fa fa-eye"></i></button>
										<button class="btn btn-success"><i class="fa fa-edit"></i></button>
										<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
								@empty
								<tr>	
									<td colspan="5">Data not found!!!</td>
								</tr>
								@endforelse
							</tbody>
						</table>
						<nav>
							<ul class="pager">
								<li>{{$schools->links('vendor.pagination.default')}}</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
		@endsection
