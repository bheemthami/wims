@extends('layouts.admin.app')

@section('title', 'Document List')

@section('content')
    <!-- Content Header (Document header) -->
    <section class="content-header">
        <h1> Documents</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Documents</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Documents List</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('documents.create') }}"> <i class="fa fa-plus"></i> Add
                        New Document</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="filteration">
                    <div class="col-md-3">
                        {{ html()->label('Title')->for('title') }}
                        <div class="form-group">
                            {{ html()->text('title')->id('title')->class('form-control')->placeholder('title') }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Academic Year')->for('academic_year_id') }}
                        <div class="form-group">
                            {{ html()->select('academic_year_id', $data['year_options'])->id('academic_year_id')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Document Type')->for('document_type_id') }}
                        {{ html()->select('document_type_id', $data['document_type_options'])->id('document_type_id')->class('form-control') }}
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Status')->for('status') }}
                        {{ html()->select('status', $data['publish_options'])->id('status')->class('form-control') }}
                    </div>

                    <div class="col-md-3">
                        {{ html()->label('Filter')->for('search-button') }}
                        <div class="form-group">
                            <button id="search-button" class="btn btn-sm btn-success" type="button">
                                <i class="fa fa-search"></i> search
                            </button>

                            <button id="clear-button" class="btn btn-sm btn-danger" type="button">
                                <i class="fa fa-eraser"></i> clear
                            </button>
                        </div>
                    </div>
                </div>

                <div id="table-wrapper">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>S.No.</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php $sno = ($documents->currentPage()==1) ? 1 : ($documents->currentPage()-1)*$documents->perPage()+1 ; @endphp
                            @forelse($documents as $document)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $document->academicYear->year }}</td>
                                    <td>{{ $document->documentType->title }}</td>
                                    <td>
                                        {{ $document->title }}
                                    </td>
                                    <td>
                                        @if ($document->image)
                                            <img src="{{ asset('uploads/documents/' . $document->image) }}" width="80px">
                                        @else
                                            <span class="text-info">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $document->date }}</td>

                                    <td>
                                        @if ($document->status == 1)
                                            <label class="label label-success">Publish</label>
                                        @else
                                            <label class="label label-default">Draft</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-button-list">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('documents.show', [$document->id]) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('documents.edit', [$document->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $document->id }}"
                                                data-route="{{ route('documents.destroy', $document->id) }}"> <i
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
                            {{ $documents->links('vendor.pagination.default') }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
    <script>
        $(document).ready(function() {
            function getFilters() {
                return {
                    title: $('#title').val(),
                    academic_year_id: $('#academic_year_id').val(),
                    document_type_id: $('#document_type_id').val(),
                    status: $('#status').val()
                };
            }

            function filterData(filters) {
                $('#custom-loader').modal('show');
                $.ajax({
                    url: "{{ url('admin/documents') }}",
                    data: filters,
                    success: function(response) {
                        $('#table-wrapper').html(response);
                        $('#custom-loader').modal('hide');
                    },
                    error: function() {
                        $('#custom-loader').modal('hide');
                        toastr.error("Oops something went wrong. Try again later!");
                    }
                });
            }

            $('#search-button').click(function() {
                var filters = getFilters();
                if (!filters.title && !filters.academic_year_id && !filters.document_type_id && !filters
                    .status) {
                    toastr.warning("Please select at least one filter criteria!");
                    return;
                }
                filterData(filters);
            });

            $('#clear-button').click(function() {
                $('#title').val('');
                $('#academic_year_id').val('');
                $('#document_type_id').val('');
                $('#status').val('');
                filterData({
                    title: null,
                    academic_year_id: null,
                    document_type_id: null,
                    status: null
                });
            });
        });
    </script>
@endsection
