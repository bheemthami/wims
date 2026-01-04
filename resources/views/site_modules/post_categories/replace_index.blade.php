<div id="table-wrapper">
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
            @php $sno = ($post_categories->currentPage()==1) ? 1 : ($post_categories->currentPage()-1)*$post_categories->perPage()+1 ; @endphp
            @forelse($post_categories as $post_category)
                <tr>
                    <td>{{ $sno++ }}</td>
                    <td>
                        {{ $post_category->title }}
                    </td>
                    <td>
                        <img src="{{ asset('uploads/post_categories/' . $post_category->image) }}" width="80px"
                            alt="NO IMAGE">
                    </td>
                    <td>{{ $post_category->order }}</td>

                    <td>
                        @if ($post_category->status == 1)
                            <label class="label label-success">Publish</label>
                        @else
                            <label class="label label-default">Draft</label>
                        @endif
                    </td>
                    <td>
                        <div class="action-button-list">
                            <a class="btn btn-sm btn-success"
                                href="{{ route('post-categories.edit', [$post_category->id]) }}"><i
                                    class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                data-id="{{ $post_category->id }}"
                                data-route="{{ route('post-categories.destroy', $post_category->id) }}"> <i
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
            {{ $post_categories->links('vendor.pagination.default') }}
        </ul>
    </div>
</div>
