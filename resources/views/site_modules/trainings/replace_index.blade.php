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