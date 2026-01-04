@extends('layouts.admin.app')

@section('title', 'Page > View details')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('pages.index') }}">Teachers</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('pages.edit', [$page->id]) }}"><i
                            class="fa fa-edit"></i></a>

                    <a class="btn btn-sm btn-danger" href="{{ route('pages.index') }}"><i class="fa fa-times"></i></a>

                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>

            <div class="box-body">
                <fieldset class="fieldset-border">
                    <legend class="legend-border">Page Details</legend>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row-auto">
                                <div class="col-md-12">
                                    <h4 class="box-title">Title:</h4>
                                    <p>{{ $page->title }} </p>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="box-title">Summary:</h4>
                                    <p>{{ $page->summary }} </p>
                                </div>

                                <div class="col-md-12">
                                    <h4 class="box-title">Body:</h4>
                                    <p>{!! $page->description !!} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row-auto">
                                <div class="col-md-12">
                                    <h4 class="box-title">Uploaded Image:</h4>
                                    @if ($page->image)
                                        <a href="{{ asset('uploads/pages/' . $page->image) }}" target="_blank">
                                            <div class="img-wrapper">
                                                <img src="{{ asset('uploads/pages/' . $page->image) }}" alt="No Image">
                                            </div>
                                        </a>
                                    @else
                                        <strong>No image</strong>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <h4 class="box-title">Attachment:</h4>
                                    @if ($page->attachment)
                                        <a class="btn btn-sm btn-success"
                                            href ="{{ asset('uploads/pages/' . $page->attachment) }}" target="_blank"><i
                                                class="fa fa-eye"></i> view</a>
                                    @else
                                        <strong>No attachment</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="legend-border">Website Options</legend>
                    <div class="row-auto">
                        <div class="col-md-6">
                            <p><strong> Display Order: </strong><label
                                    class="label label-success">{{ $page->order }}</label>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Publish status: </strong> {{ $page->status == 1 ? 'Publish' : 'Draft' }}</p>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
