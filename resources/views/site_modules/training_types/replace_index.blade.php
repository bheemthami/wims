<div id="table-wrapper" >
	<table class="table table-bordered table-striped">
		<thead>
			<th>S.No.</th>
			<th>Title</th>
			<th>Order</th>
			<th>Status</th>
			<th>Action</th>
		</thead>
		<tbody>
			@php $sno = ($training_types->currentPage()==1) ? 1 : ($training_types->currentPage()-1)*$training_types->perPage()+1 ; @endphp
			@forelse($training_types as $training_type)
			<tr>
				<td>{{ $sno++ }}</td>
				<td>
					{{ $training_type->title }}
				</td>
				<td>{{ $training_type->order }}</td>

				<td>
					@if($training_type->status == 1)
					<label class="label label-success">Publish</label>
					@else
					<label class="label label-default">Draft</label>
					@endif
				</td>
				<td>
					<a class="btn btn-sm btn-success" href="{{ route('training-types.edit',[$training_type->id])}}"><i class="fa fa-edit"></i></a>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$training_type->id}}" data-route="{{route('training-types.destroy', $training_type->id) }}"> <i class="fa fa-trash"></i></a>

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
			{{$training_types->links('vendor.pagination.default')}}
		</ul>
	</div>
</div>