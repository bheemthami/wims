@extends('layouts.admin.app')

@section('title', 'Document > View details')

@section('content')
    <!-- Content Header (Document header) -->
    <section class="content-header">
        <h1> Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('documents.index') }}">Documents</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('documents.edit', [$document->id]) }}"><i
                            class="fa fa-edit"></i></a>

                    <a class="btn btn-sm btn-danger" href="{{ route('documents.index') }}"><i class="fa fa-times"></i></a>
                </div>
            </div>

            <div class="box-body">
                <fieldset class="fieldset-border">
                    <legend class="legend-border">Document Details</legend>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row-auto">
                                <div class="col-md-6">
                                    <h4>Year:</h4>
                                    <p>{{ $document->academicYear->year }} </p>
                                </div>

                                <div class="col-md-6">
                                    <h4>Document Type:</h4>
                                    <p>{{ $document->documentType->title }} </p>
                                </div>

                                <div class="col-md-12">
                                    <h4>Title:</h4>
                                    <p>{{ $document->title }} </p>
                                </div>
                                <div class="col-md-12">
                                    <h4>Summary:</h4>
                                    <p>{{ $document->summary ? $document->summary : '-' }} </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row-auto">
                                <div class="col-md-12">
                                    <h4>Image:</h4>
                                    @if ($document->image)
                                        <div class="img-wrapper">
                                            <img src="{{ asset('uploads/documents/' . $document->image) }}" width="200px">
                                        </div>
                                    @else
                                        <strong>No image</strong>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <h4>Attachment:</h4>
                                    @if ($document->attachment)
                                        <a class="btn btn-sm btn-success"
                                            href ="{{ asset('uploads/documents/' . $document->attachment) }}"
                                            target="_blank"><i class="fa fa-eye"></i> view</a>
                                    @else
                                        <strong>No attachment</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="legend-border">Website Options</legend>
                    <div class="row-auto">
                        <div class="col-md-4">
                            <p>Display Order:<label class="label label-success">{{ $document->order }}</label>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>Date :<label class="label label-success">{{ $document->date }}</label>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Publish status: <label
                                        class="label label-{{ $document->status ? 'success' : 'warning' }}">{{ $document->status ? 'Publish' : 'Draft' }}
                                    </label></p>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
