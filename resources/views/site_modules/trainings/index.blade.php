@extends('layouts.admin.app')

@section('title','Training List')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Trainings</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Trainings</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Trainings List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('trainings.create')}}"> <i class="fa fa-plus"></i> Add New Training</a>
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="filteration">
				<div class="col-md-3">
					<label for="title"> Title  </label>
					<div class="form-group">
						<input id="title" name="title" class="form-control" placeholder="title">
					</div>
				</div>

				<div class="col-md-3">
					<label for="training_category_id"> Category  </label>
					<div class="form-group">
						{!! Form::select('training_category_id',$trainingCategoryOptions,null,['class'=>'form-control','id'=>'training_category_id']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="traning_type_id"> Type  </label>
					<div class="form-group">
						{!! Form::select('training_type_id',$trainingTypeOptions,null,['class'=>'form-control','id'=>'training_type_id']) !!}
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
						<th>Category</th>
						<th>Type</th>
						<th>Quota</th>
						<th>Duration</th>
						<th>Eligibility</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($trainings->currentPage()==1) ? 1 : ($trainings->currentPage()-1)*$trainings->perPage()+1 ; @endphp
						@forelse($trainings as $training)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>{{ $training->title }}</td>
							<td>{{ $training->trainingCategory->title }}</td>
							<td>{{ $training->trainingType->title }}</td>
							<td>{{ $training->quota }}</td>
							<td>{{ $training->duration }}</td>
							<td>{{ $training->eligibility }}</td>							
							<td>
								@if($training->status == 1)
								<label class="label label-success">Published</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								<a class="btn btn-sm btn-primary" href="{{ route('trainings.show',[$training->id])}}"><i class="fa fa-eye"></i></a>
								<a class="btn btn-sm btn-success" href="{{ route('trainings.edit',[$training->id])}}"><i class="fa fa-edit"></i></a>
								<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$training->id}}" data-route="{{route('trainings.destroy', $training->id) }}"> <i class="fa fa-trash"></i></a>

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
						{{$trainings->links('vendor.pagination.default')}}
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
			var training_category_id = $('#training_category_id').val();
			var training_type_id = $('#training_type_id').val();
			var baseUrl = "<?php echo url('admin/trainings')?>";
			$.ajax({
				url : baseUrl,
				data : {title:title,training_category_id:training_category_id,training_type_id:training_type_id},
				success:function(response){
					$(document).find('#table-wrapper').html(response);
				}
			});
		});

		$('#clear-button').click(function(){
			$('#title').val('');
			$('#training_category_id').val('');
			$('#training_type_id').val('');
		});
	});
</script>
@endsection