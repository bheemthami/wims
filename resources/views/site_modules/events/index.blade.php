@extends('layouts.admin.app')

@section('title', 'Event List')

@section('content')
    <!-- Content Header (Event header) -->
    <section class="content-header">
        <h1> Events</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Events</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Events List</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('events.create') }}"> <i class="fa fa-plus"></i> Add
                        New Event
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row filtration">
                    <div class="col-md-3">
                        {{ html()->label('Title')->for('title') }}
                        <div class="form-group">
                            {{ html()->text('title')->id('title')->class('form-control')->placeholder('title') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        {{ html()->label('Year')->for('academic_year_id') }}
                        <div class="form-group">
                            {{ html()->select('academic_year_id', $yearOptions)->id('academic_year_id')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        {{ html()->label('Status')->for('status') }}
                        <div class="form-group">
                            {{ html()->select('status', $statusOptions)->id('status')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        @include('include.search-and-clear-buttons')
                    </div>
                </div>

                <div id="table-wrapper" class="table-responsive">
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
                                        <img src="{{ asset('uploads/events/' . $event->image) }}" width="80px">
                                    </td>
                                    <td>

                                        <span>
                                            {{ date('Y-m-d', strtotime($event->start_time)) }}, {{ $event->start_time }}
                                        </span>
                                        <br>
                                        <span>
                                            {{ date('Y-m-d', strtotime($event->end_time)) }}, {{ $event->end_time }}
                                        </span>
                                    </td>
                                    <td>{{ $event->speaker ? $event->speaker : '-' }}</td>

                                    <td>
                                        @if ($event->status == 1)
                                            <label class="label label-success">Published</label>
                                        @else
                                            <label class="label label-default">Draft</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-button-list">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('events.show', [$event->id]) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('events.edit', [$event->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $event->id }}"
                                                data-route="{{ route('events.destroy', $event->id) }}"> <i
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
                            {{ $events->links('vendor.pagination.default') }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            function getFilters() {
                return {
                    title: $('#title').val(),
                    academic_year_id: $('#academic_year_id').val(),
                    status: $('#status').val()
                };
            }

            function filterData(filters) {
                $('#custom-loader').modal('show');
                $.ajax({
                    url: "{{ url('admin/events') }}",
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
                if (!filters.title && !filters.academic_year_id && !filters.status) {
                    toastr.warning("Please select at least one filter criteria!");
                    return;
                }
                filterData(filters);
            });

            $('#clear-button').click(function() {
                var filters = getFilters();
                if (filters.title || filters.academic_year_id || filters.status) {
                    $('#title').val('');
                    $('#academic_year_id').val('');
                    $('#status').val('');
                    filterData({
                        title: null,
                        academic_year_id: null,
                        status: null
                    });
                }
            });
        });
    </script>
@endsection
