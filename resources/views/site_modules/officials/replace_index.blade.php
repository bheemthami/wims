<div id="table-wrapper">
    <table class="table table-bordered table-striped">
        <thead>
            <th>S.No.</th>
            <th>Department</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Is working</th>
            <th>Is Published</th>
            <th>Is Published on front</th>
            <th>Order</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php $sno = ($officials->currentPage()==1) ? 1 : ($officials->currentPage()-1)*$officials->perPage()+1 ; @endphp
            @forelse($officials as $official)
                <tr>
                    <td>{{ $sno++ }}</td>
                    <td>{{ $official->department->title }}</td>
                    <td>
                        {{ strtoupper($official->first_name) }}
                        {{ strtoupper($official->middle_name ? $official->middle_name : '') }}
                        {{ strtoupper($official->last_name) }}
                    </td>
                    <td>{{ ucwords($official->mobile) }}</td>

                    <td>
                        @if ($official->working_status == 1)
                            <label class="label label-success">YES</label>
                        @else
                            <label class="label label-default">NO</label>
                        @endif
                    </td>

                    <td>
                        @if ($official->status == 1)
                            <label class="label label-success">Published</label>
                        @else
                            <label class="label label-danger">Draft</label>
                        @endif
                    </td>

                    <td>
                        @if ($official->show_on_front_page == 1)
                            <label class="label label-success">Yes</label>
                        @else
                            <label class="label label-danger">No </label>
                        @endif
                    </td>

                    <td>{{ $official->order }}</td>
                    <td>
                        <div class="action-button-list">
                            <a class="btn btn-sm btn-primary" href="{{ route('officials.show', [$official->id]) }}"><i
                                    class="fa fa-eye"></i></a>
                            <a class="btn btn-sm btn-success" href="{{ route('officials.edit', [$official->id]) }}"><i
                                    class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                data-id="{{ $official->id }}"
                                data-route="{{ route('officials.destroy', $official->id) }}"> <i
                                    class="fa fa-trash"></i></a>
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
            {{ $officials->links('vendor.pagination.default') }}
        </ul>
    </div>
</div>
