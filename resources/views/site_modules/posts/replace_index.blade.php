<div id="table-wrapper" class="table-responsive px-15">
    <table class="table table-bordered table-striped">
        <thead>
            <th>S.No.</th>
            <th>Category</th>
            <th>Title</th>
            <th>Image</th>
            <th>Published on</th>
            <th>Status</th>
            <th>Show on popup</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php $sno = ($posts->currentPage()==1) ? 1 : ($posts->currentPage()-1)*$posts->perPage()+1 ; @endphp
            @forelse($posts as $post)
                <tr>
                    <td>{{ $sno++ }}</td>
                    <td>{{ $post->postCategory->title }}</td>
                    <td>
                        {{ Str::limit($post->title, 50) }}
                    </td>
                    <td>
                        @if ($post->image)
                            <div class="img-wrapper">
                                <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="No image">
                            </div>
                        @else
                            <span class="text-danger">No Image</span>
                        @endif
                    </td>
                    <td>{{ $post->date }}</td>
                    <td>
                        @if ($post->status == 1)
                            <label class="label label-success">Published</label>
                        @else
                            <label class="label label-default">Draft</label>
                        @endif
                    </td>
                    <td>
                        @if ($post->show_on_modal == 1)
                            <label class="label label-success">Yes</label>
                        @else
                            <label class="label label-default">No</label>
                        @endif
                    </td>
                    <td>
                        <div class="action-button-list">
                            <a class="btn btn-sm btn-primary" href="{{ route('posts.show', [$post->id]) }}"><i
                                    class="fa fa-eye"></i></a>
                            <a class="btn btn-sm btn-success" href="{{ route('posts.edit', [$post->id]) }}"><i
                                    class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                data-id="{{ $post->id }}" data-route="{{ route('posts.destroy', $post->id) }}"> <i
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
            {{ $posts->links('vendor.pagination.default') }}
        </ul>
    </div>
</div>
