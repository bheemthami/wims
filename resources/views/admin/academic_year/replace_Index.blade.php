<table class="table table-responsive table-bordered table-striped">
	<thead>
		<th>S.No.</th>
		<th>Year</th>
		<th>Actions</th>
	</thead>
	<tbody>
		@php $sno = 1*$aca_years->currentPage(); @endphp
		@forelse($aca_years as $aca_year)
		<tr>
			<td>{{ $sno++ }}</td>
			<td>{{ $aca_year->year }}</td>
			<td>
				<div class="action-button-list">
					<a class="btn btn-sm btn-success" href="{{route('academic-years.edit',$aca_year->id)}}"><i class="fa fa-edit"></i></a>
					<a class="btn btn-sm btn-danger disabled" data-toggle="modal" data-target="#deleteModal" data-id="{{$aca_year->id}}" data-route="{{route('academic-years.destroy', $aca_year->id) }}"><i class="fa fa-trash"></i></a>
				</div>
			</td>
		</tr>
		@empty
		<tr>
			<td colspan="5">Data not found!!!</td>
		</tr>
		@endforelse
	</tbody>
</table>
