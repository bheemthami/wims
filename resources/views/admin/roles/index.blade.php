@extends('layouts.admin.app')
@section('content')
@section('title')
Roles
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Roles</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Roles</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<a class="btn btn-sm btn-success" href="{{ route('roles.create') }}"> <i class="fa fa-plus"></i> Add Role</a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div id="replaceTable ">
				<table class="table table-responsive table-bordered table-striped">
					<thead>
						<th>S.No.</th>
						<th>Name</th>
						<th>Permissions</th>
						<th>Actions</th>
					</thead>
					<tbody>
						@php $sno = 1*$roles->currentPage(); @endphp
						@forelse($roles as $role)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>{{ $role->name }}</td>
							<td>

								@if($role->permissions && strtolower($role->name) =='admin')
								<a class="btn btn-sm btn-warning disabled" href="{{route('create.role.permissions',$role->id)}}"><i class="fa fa-key"></i> Set </a>

								<a class="btn btn-sm btn-info disabled" href="{{route('edit.role.permissions',$role->id)}}"><i class="fa fa-pencil"></i> Edit </a>

								<a class="btn btn-sm btn-info" href="{{route('show.role.permissions',$role->id)}}"><i class="fa fa-eye"></i> View</a>

								@else
								<a class="btn btn-sm btn-warning" href="{{route('create.role.permissions',$role->id)}}"><i class="fa fa-key"></i> Set </a>

								@endif

								@if($role->permissions)
								@if($role->permissions && strtolower($role->name) !='admin')
								<a class="btn btn-sm btn-info" href="{{route('edit.role.permissions',$role->id)}}"><i class="fa fa-pencil"></i> Edit </a>

								<a class="btn btn-sm btn-info" href="{{route('show.role.permissions',$role->id)}}"><i class="fa fa-eye"></i> View</a>

								<a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$role->id}}" data-route="{{route('destroy.role.permissions', $role->id) }}"><i class="fa fa-trash"></i> Delete </a>
								@endif
								@endif
							</td>
							<td>
								<div class="action-button-list">
									<a class="btn btn-sm btn-success" href="{{route('roles.edit',$role->id)}}"><i class="fa fa-edit"></i></a>
									<a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$role->id}}" data-route="{{route('roles.destroy', $role->id) }}"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="5">Data not found!!!</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
		<div class="box-footer clearfix">
			<ul class="pagination pagination-sm no-margin pull-right">
				{{$roles->links('vendor.pagination.default')}}
			</ul>
		</div>
	</div>
</section>

<script type="text/javascript">
	function paginate(page) {
		loadPaginatedData(page);
	}

	function loadPaginatedData(page = 1, perPage = 1) {
		$.ajax({
			url: '{{ url("admin/roles") }}',
			method: 'GET',
			data: {
				'page': page,
				'perPage': perPage
			},
		}).done(function(response) {
			$('#replaceTable').replaceWith(response);
		}).fail(function() {
			alert('Something went wrong, Try again later!!!')
		})
	}
</script>
@endsection
