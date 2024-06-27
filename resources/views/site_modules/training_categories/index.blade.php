@extends('layouts.admin.app')

@section('title','Training Category List')

@section('content')
<!-- Content Header (Training Category header) -->
<section class="content-header">
	<h1> Training Category</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Training Category</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('training-categories.create')}}"> <i class="fa fa-plus"></i> Add New Training Category</a>
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="filteration">
				<div class="col-md-3">
					<label for="first_name"> Title  </label>
					<div class="form-group">
						<input id="title" name="title" class="form-control" placeholder="title">
					</div>
				</div>

				<div class="col-md-3">
					<label for="dob"> Filter</label>
					<div class="form-group">
						<button id="search-button" class="btn btn-sm btn-success" type="button"> <i class="fa fa-search"></i> search</button>
						<button id="clear-button" class="btn btn-sm btn-danger" type="button"> <i class="fa fa-eraser"></i> clear</button>
					</div>
				</div>
			</div>
			<div id="table-wrapper" >
				<table class="table table-bordered table-striped">
					<thead>
						<th>S.No.</th>
						<th>Title</th>
						<th>Image</th>
						<th>Order</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($training_categories->currentPage()==1) ? 1 : ($training_categories->currentPage()-1)*$training_categories->perPage()+1 ; @endphp
						@forelse($training_categories as $training_category)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>
								{{ $training_category->title }}
							</td>
							<td>
								<img src="{{asset('uploads/training_categories/'.$training_category->image)}}" width="80px">
							</td>
							<td>{{ $training_category->order }}</td>
														
							<td>
								@if($training_category->status == 1)
								<label class="label label-success">Publish</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								<a class="btn btn-sm btn-success" href="{{ route('training-categories.edit',[$training_category->id])}}"><i class="fa fa-edit"></i></a>
								<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$training_category->id}}" data-route="{{route('training-categories.destroy', $training_category->id) }}"> <i class="fa fa-trash"></i></a>

							</td>
						</tr>
						@empty
						<tr>
							<td colspan="8"> Not found!!!</td>
						</tr>
						@endforelse

					</tbody>
				</table>


				<!-- /.box-body -->
				<div class="box-footer clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						{{$training_categories->links('vendor.pagination.default')}}
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box -->
</section>

<script>
	$(document).ready(function(){
		$('#search-button').click(function(){
			var title = $('#title').val();
			var baseUrl = "<?php echo url('admin/training-categories')?>";
			$.ajax({
				url : baseUrl,
				data : {'title':title},
				success:function(response){
					$(document).find('#table-wrapper').html(response);
				}
			});
		});

		$('#clear-button').click(function(){
			$('#title').val('');
		});
	});
</script>
@endsection