@extends('layouts.admin.app')

@section('title', 'Official > List')

@section('content')
    <!-- Content Header (Official header) -->
    <section class="content-header">
        <h1> Officials</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Officials</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Officials List</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('officials.create') }}"> <i class="fa fa-plus"></i> Add
                        New Official</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body no-padding">
                <div class="row filteration px-15">

                    <div class="col-md-2">
                        {{ html()->label('Department')->for('department_id') }}
                        {{ html()->select('department_id', $data['department_options'])->id('department_id')->class('form-control') }}
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Working Status')->for('working_status') }}
                        {{ html()->select('working_status', $data['working_status_options'])->id('working_status')->class('form-control') }}
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Is Teaching Official')->for('is_teaching_official') }}
                        {{ html()->select('is_teaching_official', $data['working_status_options'])->id('is_teaching_official')->class('form-control') }}
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Is published')->for('status') }}
                        {{ html()->select('status', $data['publish_options'])->id('status')->class('form-control') }}
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('First Name')->for('first_name') }}
                        <div class="form-group">
                            {{ html()->text('first_name')->id('first_name')->class('form-control')->placeholder('Enter first name') }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Filter')->for('search-button') }}
                        <div class="form-group">
                            <button id="search-button" class="btn btn-sm btn-success" type="button">
                                <i class="fa fa-filter"></i> Filter
                            </button>

                            <button id="clear-button" class="btn btn-sm btn-danger" type="button">
                                <i class="fa fa-eraser"></i> clear
                            </button>
                        </div>
                    </div>

                </div>

                <div id="table-wrapper" class="table-responsive px-15">
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
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('officials.show', [$official->id]) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('officials.edit', [$official->id]) }}"><i
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
            </div>
        </div>
        <!-- /.box -->
    </section>

    <script>
        $(document).ready(function() {
            function getFilters() {
                return {
                    first_name: $('#first_name').val(),
                    department_id: $('#department_id').val(),
                    working_status: $('#working_status').val(),
                    is_teaching_official: $('#is_teaching_official').val(),
                    status: $('#status').val()
                };
            }

            function filterData(filters) {
                $('#custom-loader').modal('show');
                $.ajax({
                    url: "{{ url('admin/officials') }}",
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
                if (!filters.first_name && !filters.department_id && !filters.working_status && !filters
                    .is_teaching_official && !filters.status) {
                    toastr.warning("Please select at least one filter criteria!");
                    return;
                }
                filterData(filters);
            });

            $('#clear-button').click(function() {
                var filters = getFilters();
                if (filters.first_name || filters.department_id || filters.working_status || filters
                    .is_teaching_official || filters.status) {
                    $('#first_name').val('');
                    $('#department_id').val('');
                    $('#working_status').val('');
                    $('#is_teaching_official').val('');
                    $('#status').val('');
                    filterData({
                        first_name: null,
                        department_id: null,
                        working_status: null,
                        is_teaching_official: null,
                        status: null
                    });
                }
            });
        });
    </script>
@endsection
