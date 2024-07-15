<div id="table-wrapper">
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
					<div class="action-button-list">
						<a class="btn btn-sm btn-primary" href="{{ route('documents.show',[$document->id])}}"><i class="fa fa-eye"></i></a>
						<a class="btn btn-sm btn-success" href="{{ route('documents.edit',[$document->id])}}"><i class="fa fa-edit"></i></a>
						<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$document->id}}" data-route="{{route('documents.destroy', $document->id) }}"> <i class="fa fa-trash"></i></a>
					</div>
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
