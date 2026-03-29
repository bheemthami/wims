<div id="table-wrapper">
    <table class="table table-bordered table-striped">
        <thead>
            <th>S.No.</th>
            <th>Type</th>
            <th>Link</th>
            <th>Order</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php $sno = ($quick_links->currentPage()==1) ? 1 : ($quick_links->currentPage()-1)*$quick_links->perPage()+1 ; @endphp
            @forelse($quick_links as $quick_link)
                <tr>
                    <td>{{ $sno++ }}</td>
                    <td>{{ $quick_link->type }}</td>
                    <td>
                        <a href="{{ $quick_link->link }}" target="_blank"> {{ $quick_link->title }} <i
                                class="fa fa-external-link"></i></a>
                    </td>
                    <td>{{ $quick_link->order }}</td>

                    <td>
                        @if ($quick_link->status == 1)
                            <label class="label label-success">Publish</label>
                        @else
                            <label class="label label-default">Draft</label>
                        @endif
                    </td>
                    <td>
                        <div class="action-button-list">
                            <a class="btn btn-sm btn-success" href="{{ route('quick-links.edit', [$quick_link->id]) }}"><i
                                    class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                data-id="{{ $quick_link->id }}"
                                data-route="{{ route('quick-links.destroy', $quick_link->id) }}"> <i
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
            {{ $quick_links->links('vendor.pagination.default') }}
        </ul>
    </div>
</div>
