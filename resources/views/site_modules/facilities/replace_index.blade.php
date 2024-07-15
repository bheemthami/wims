<div id="table-wrapper">
	<table class="table table-bordered table-striped">
		<thead>
			<th>S.No.</th>
			<th>Title</th>
			<th>Image</th>
			<th>Order</th>
			<th>Summary</th>
			<th>Status</th>
			<th>Action</th>
		</thead>
		<tbody>
			@php $sno = ($facilities->currentPage()==1) ? 1 : ($facilities->currentPage()-1)*$facilities->perPage()+1 ; @endphp
			@forelse($facilities as $facility)
			<tr>
				<td>{{ $sno++ }}</td>
				<td>
					{{ $facility->title }}
				</td>
				<td>
					<img src="{{asset('uploads/facilities/'.$facility->image)}}" width="80px">
				</td>
				<td>{{ $facility->order }}</td>
				<td>{!! substr($facility->summary,0,100) !!}</td>

				<td>
					@if($facility->status == 1)
					<label class="label label-success">Active</label>
					@else
					<label class="label label-default">Inactive</label>
					@endif
				</td>
				<td>
					<div class="action-button-list">
						<a class="btn btn-sm btn-primary" href="{{ route('facilities.show',[$facility->id])}}"><i class="fa fa-eye"></i></a>
						<a class="btn btn-sm btn-success" href="{{ route('facilities.edit',[$facility->id])}}"><i class="fa fa-edit"></i></a>
						<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$facility->id}}" data-route="{{route('facilities.destroy', $facility->id) }}"> <i class="fa fa-trash"></i></a>
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
			{{$facilities->links('vendor.pagination.default')}}
		</ul>
	</div>
</div>
