@extends('layouts.admin.app')

@section('title','Academic Year')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Academic Years</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Academic Years</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<a class="btn btn-sm btn-success" href="{{ route('academic-years.create') }}"> <i class="fa fa-plus"></i> Add Academic Year</a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div id="replaceTable ">
				<table class="table table-responsive table-bordered table-striped">
					<thead>
						<th>S.No.</th>
						<th>Year</th>
						<th>Year (AD)</th>
						<th>School Opening days</th>
						<th>Grading System</th>
						<th>No of exams</th>
						<th>Actions</th>
					</thead>
					<tbody>
						@php $sno = 1*$aca_years->currentPage(); @endphp
						@forelse($aca_years as $aca_year)
						<tr>	
							<td>{{ $sno++ }}</td>
							<td>{{ $aca_year->year }}</td>
							<td>{{ $aca_year->year_eng }}</td>
							<td>{{ $aca_year->school_open_days }}</td>
							<td>{{ $aca_year->gradingSystem->name }}</td>
							<td>
								<button class="btn btn-sm btn-info">
									{{ $aca_year->no_of_exams }}
								</button>
								<a class="btn btn-sm btn-success" href="{{route('create_terminals',$aca_year->id)}}"><i class="fa fa-plus"></i> Set terminals</a>
							</td>
							<td>
								<a class="btn btn-sm btn-success" href="{{route('academic-years.edit',$aca_year->id)}}"><i class="fa fa-edit"></i></a>
								<a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$aca_year->id}}" data-route="{{route('academic-years.destroy', $aca_year->id) }}"><i class="fa fa-trash"></i></a>
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
				{{$aca_years->links('vendor.pagination.default')}}
			</ul>
		</div>
	</div>
</section>

<script type="text/javascript">
	function paginate(page){
		loadPaginatedData(page);
	}

	function loadPaginatedData(page = 1, perPage = 1){
		$.ajax({
			url: '{{ url("admin/academic-years") }}',
			method:'GET',
			data: {'page':page,'perPage':perPage},
		}).done(function(response){
			$('#replaceTable').replaceWith(response);
		}).fail(function(){
			alert('Something went wrong, Try again later!!!')
		})
	}

</script>
@endsection
