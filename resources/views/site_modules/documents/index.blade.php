@extends('layouts.admin.app')

@section('title','Document List')

@section('content')
<!-- Content Header (Document header) -->
<section class="content-header">
	<h1> Documents</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Documents</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Documents List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('documents.create')}}"> <i class="fa fa-plus"></i> Add New Document</a>
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

				<div class="col-md-2">
					<label for="title"> Academic Year  </label>
					<div class="form-group">
						{!! Form::select('academic_year_id',$data['year_options'],null,['class'=>'form-control','id'=>'academic_year_id']) !!}
					</div>
				</div>

				<div class="col-md-2">
					<label for="title"> Document Type  </label>
					{!! Form::select('document_type_id',$data['document_type_options'],null,['class'=>'form-control','id'=>'document_type_id']) !!}
				</div>

				<div class="col-md-2">
					<label for="title"> Status  </label>
					{!! Form::select('status',$data['publish_options'],null,['class'=>'form-control','id'=>'status']) !!}
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
						<th>Year</th>
						<th>Type</th>
						<th>Title</th>
						<th>Image</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($documents->currentPage()==1) ? 1 : ($documents->currentPage()-1)*$documents->perPage()+1 ; @endphp
						@forelse($documents as $document)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>{{ $document->academicYear->year }}</td>
							<td>{{ $document->documentType->title }}</td>
							<td>
								{{ $document->title }}
							</td>
							<td>
								<img src="{{asset('uploads/documents/'.$document->image)}}" width="80px">
							</td>
							<td>{{ $document->date }}</td>
							
							<td>
								@if($document->status == 1)
								<label class="label label-success">Publish</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								<a class="btn btn-sm btn-primary" href="{{ route('documents.show',[$document->id])}}"><i class="fa fa-eye"></i></a>
								<a class="btn btn-sm btn-success" href="{{ route('documents.edit',[$document->id])}}"><i class="fa fa-edit"></i></a>
								<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$document->id}}" data-route="{{route('documents.destroy', $document->id) }}"> <i class="fa fa-trash"></i></a>

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
						{{$documents->links('vendor.pagination.default')}}
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
			var academic_year_id = $('#academic_year_id').val();
			var document_type_id = $('#document_type_id').val();
			var status = $('#status').val();
			var baseUrl = "<?php echo url('admin/documents')?>";
			$.ajax({
				url : baseUrl,
				data : {'title':title,'academic_year_id':academic_year_id,'document_type_id':document_type_id,'status':status},
				success:function(response){
					$(document).find('#table-wrapper').html(response);
				}
			});
		});

		$('#clear-button').click(function(){
			$('#title').val('');
			$('#academic_year_id').val('');
			$('#document_type_id').val('');
			$('#status').val('');
		});
	});
</script>
@endsection