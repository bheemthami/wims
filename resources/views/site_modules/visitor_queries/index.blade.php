@extends('layouts.admin.app')

@section('title','Visitor Queries')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Visitor Queries</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Visitor Queries</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<a class="btn btn-sm btn-success disabled" href="{{ route('academic-years.create') }}" > <i class="fa fa-plus"></i> Add </a>
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
						<th>Qid</th>
						<th>Name</th>
						<th>Subject</th>
						<th>Message</th>
						<th>status</th>
						<th>Actions</th>
					</thead>
					<tbody>
						@php $sno = 1*$visitor_queries->currentPage(); @endphp
						@forelse($visitor_queries as $visitor_query)
						<tr>	
							<td>{{ $sno++ }} </td>
							<td>{{ $visitor_query->academicYear->year }}</td>
							<td>{{ $visitor_query->qid }}</td>
							<td>{{ $visitor_query->name }}</td>
							<td>{{ $visitor_query->subject }}</td>
							<td>
								{{ str_limit($visitor_query->message,50) }}
							</td>

							<td>
								@if($visitor_query->status == 0)
								<label class="btn btn-sm btn-warning">New Query</label>
								@else
								<label class="btn btn-sm btn-success">Replied</label>
								@endif
							</td>

							<td>
								<a class="btn btn-sm btn-info" href="{{route('visitor_queries.show',$visitor_query->id)}}"><i class="fa fa-eye"></i></a>

								<a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$visitor_query->id}}" data-route="{{route('visitor_queries.destroy', $visitor_query->id) }}"><i class="fa fa-trash"></i></a>
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
				{{$visitor_queries->links('vendor.pagination.default')}}
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
