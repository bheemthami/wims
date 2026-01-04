<div id="table-wrapper" class="table-responsive">
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
            @php $sno = ($pages->currentPage()==1) ? 1 : ($pages->currentPage()-1)*$pages->perPage()+1 ; @endphp
            @forelse($pages as $page)
                <tr>
                    <td>{{ $sno++ }}</td>
                    <td>
                        {{ $page->title }}
                    </td>
                    <td>
                        @if ($page->image)
                            <div class="img-wrapper">
                                <img src="{{ asset('uploads/pages/' . $page->image) }}" alt="No Image">
                            </div>
                        @else
                            <strong>No image</strong>
                        @endif
                    </td>
                    <td>{{ $page->order }}</td>
                    <td>{!! substr($page->summary, 0, 100) !!}</td>

                    <td>
                        @if ($page->status == 1)
                            <label class="label label-success">Published</label>
                        @else
                            <label class="label label-default">Draft</label>
                        @endif
                    </td>
                    <td>
                        <div class="action-button-list">
                            <a class="btn btn-sm btn-primary" href="{{ route('pages.show', [$page->id]) }}"><i
                                    class="fa fa-eye"></i></a>
                            <a class="btn btn-sm btn-success" href="{{ route('pages.edit', [$page->id]) }}"><i
                                    class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                data-id="{{ $page->id }}" data-route="{{ route('pages.destroy', $page->id) }}"> <i
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
            {{ $pages->links('vendor.pagination.default') }}
        </ul>
    </div>
</div>
