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
			@php $sno = ($document_types->currentPage()==1) ? 1 : ($document_types->currentPage()-1)*$document_types->perPage()+1 ; @endphp
			@forelse($document_types as $document_type)
			<tr>
				<td>{{ $sno++ }}</td>
				<td>
					{{ $document_type->title }}
				</td>
				<td>
					<img src="{{asset('uploads/document_types/'.$document_type->image)}}" width="80px">
				</td>
				<td>{{ $document_type->order }}</td>
				
				<td>
					@if($document_type->status == 1)
					<label class="label label-success">Publish</label>
					@else
					<label class="label label-default">Draft</label>
					@endif
				</td>
				<td>
					<a class="btn btn-sm btn-success" href="{{ route('document-types.edit',[$document_type->id])}}"><i class="fa fa-edit"></i></a>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$document_type->id}}" data-route="{{route('document-types.destroy', $document_type->id) }}"> <i class="fa fa-trash"></i></a>

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
			{{$document_types->links('vendor.pagination.default')}}
		</ul>
	</div>
</div>