@extends('layouts.admin.app')

@section('title', 'Post > View details')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('posts.index') }}">Posts</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('posts.edit', [$post->id]) }}"><i
                            class="fa fa-edit"></i></a>

                    <a class="btn btn-sm btn-danger" href="{{ route('posts.index') }}"><i class="fa fa-times"></i></a>
                </div>
            </div>

            <div class="box-body">
                <fieldset class="fieldset-border">
                    <legend class="legend-border">Post Details</legend>
                    <div class="row-auto">
                        <div class="col-md-8">
                            <div class="row-auto">
                                <div class="col-md-12">
                                    <h4 class="box-title">Year:</h4>
                                    <p>{{ $post->academicYear->year }} </p>
                                </div>

                                <div class="col-md-12">
                                    <h4 class="box-title">Category:</h4>
                                    <p>{{ $post->postCategory->title }} </p>
                                </div>

                                <div class="col-md-12">
                                    <h4 class="box-title">Title:</h4>
                                    <p>{{ $post->title }} </p>
                                </div>

                                <div class="col-md-12">
                                    <h4 class="box-title">Summary:</h4>
                                    <p>{{ $post->summary ? $post->summary : ' - ' }} </p>
                                </div>

                                <div class="col-md-12">
                                    <h4 class="box-title">Description:</h4>
                                    <p>{!! $post->description ? $post->description : ' - ' !!} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row-auto">
                                <div class="mb-3 col-md-12">
                                    <h4>Uploaded Image:</h4>
                                    @if ($post->image)
                                        <a href="{{ asset('uploads/posts/' . $post->image) }}" target="_blank">
                                            <div class="img-wrapper">
                                                <img class="img img-responsive"
                                                    src="{{ asset('uploads/posts/' . $post->image) }}">
                                            </div>
                                        </a>
                                    @else
                                        <strong>No image</strong>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-12">
                                    <h4>Attachment:</h4>
                                    @if ($post->attachment)
                                        <a href="{{ asset('uploads/posts/' . $post->attachment) }}" target="_blank"><i
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
                    <legend class="legend-border">Website Publish Options</legend>
                    <div class="mb-3 row-auto">
                        <div class="col-md-4">
                            <p><strong>Publish status: </strong> <label for=""
                                    class="label label-{{ $post->status ? 'success' : 'warning' }}">
                                    {{ $post->status == 1 ? 'Publish' : 'Draft' }} </label></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Show on popup: </strong> <label for=""
                                    class="label label-{{ $post->status ? 'success' : 'warning' }}">
                                    {{ $post->status == 1 ? 'YES' : 'NO' }} </label></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong> Published date: </strong><label
                                    class="label label-info">{{ $post->date }}</label></p>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
