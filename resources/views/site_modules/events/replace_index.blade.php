	<div id="table-wrapper">
		<table class="table table-bordered table-striped">
			<thead>
				<th>S.No.</th>
				<th>Title</th>
				<th>Banner</th>
				<th>Date</th>
				<th>Speaker</th>
				<th>Status</th>
				<th>Action</th>
			</thead>
			<tbody>
				@php $sno = ($events->currentPage()==1) ? 1 : ($events->currentPage()-1)*$events->perPage()+1 ; @endphp
				@forelse($events as $event)
				<tr>
					<td>{{ $sno++ }}</td>
					<td>
						{{ $event->title }}
					</td>
					<td>
						<img src="{{asset('uploads/events/'.$event->image)}}" width="80px">
					</td>
					<td>
						{{ date('Y-m-d',strtotime($event->start_time)) }}, {{ $event->start_time}} -
						{{ date('Y-m-d',strtotime($event->end_time)) }}, {{ $event->end_time}}
					</td>
					<td>{{ $event->speaker ? $event->speaker : '-'}}</td>

					<td>
						@if($event->status == 1)
						<label class="label label-success">Published</label>
						@else
						<label class="label label-default">Draft</label>
						@endif
					</td>
					<td>
						<div class="action-button-list">
							<a class="btn btn-sm btn-primary" href="{{ route('events.show',[$event->id])}}"><i class="fa fa-eye"></i></a>
							<a class="btn btn-sm btn-success" href="{{ route('events.edit',[$event->id])}}"><i class="fa fa-edit"></i></a>
							<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$event->id}}" data-route="{{route('events.destroy', $event->id) }}"> <i class="fa fa-trash"></i></a>
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
				{{$events->links('vendor.pagination.default')}}
			</ul>
		</div>
	</div>
