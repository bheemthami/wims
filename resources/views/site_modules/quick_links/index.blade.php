@extends('layouts.admin.app')

@section('title', 'Quick Link List')

@section('content')
    <!-- Content Header (Quick Link header) -->
    <section class="content-header">
        <h1> Quick Links</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Quick Links</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('quick-links.create') }}"> <i class="fa fa-plus"></i>
                        Add New Quick Link</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row filteration">
                    <div class="col-md-3">
                        <label for="first_name"> Title </label>
                        <div class="form-group">
                            <input id="title" name="title" class="form-control" placeholder="title">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="dob"> Filter</label>
                        <div class="form-group">
                            <button id="search-button" class="btn btn-sm btn-success" type="button"> <i
                                    class="fa fa-search"></i> search</button>
                            <button id="clear-button" class="btn btn-sm btn-danger" type="button"> <i
                                    class="fa fa-eraser"></i> clear</button>
                        </div>
                    </div>
                </div>
                <div id="table-wrapper" class="table-responsive">
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
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('quick-links.edit', [$quick_link->id]) }}"><i
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
                    title: $('#title').val()
                };
            }

            function filterData(filters) {
                $('#custom-loader').modal('show');
                $.ajax({
                    url: "<?php echo url('admin/quick-links'); ?>",
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
                if (!filters.title) {
                    toastr.warning("Please enter a title to search!");
                    return;
                }
                filterData(filters);
            });

            $('#clear-button').click(function() {
                var filters = getFilters();
                if (filters.title) {
                    $('#title').val('');
                    filterData({
                        title: null
                    });
                }
            });
        });
    </script>
@endsection
