@extends('layouts.admin.app')

@section('title', 'Post > View details')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('testimonials.index') }}">Post</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('testimonials.edit', [$testimonial->id]) }}"><i
                            class="fa fa-edit"></i></a>

                    <a class="btn btn-sm btn-danger" href="{{ route('testimonials.index') }}"><i
                            class="fa fa-times"></i></a>
                </div>
            </div>

            <div class="box-body">
                <fieldset class="fieldset-border">
                    <legend class="legend-border">Details</legend>
                    <div class="row-auto">
                        <div class="col-md-8">
                            <div class="row-auto">
                                <div class="mb-3 col-md-12">
                                    <label for="title" class="col-sm-2 col-form-label">Statement by</label>
                                    <div class="col-sm-10">
                                        <p>{{ $testimonial->statement_by }} </p>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="statement" class="col-sm-2 col-form-label">Statement</label>
                                    <div class="col-sm-10">
                                        <p>{{ $testimonial->statement }} </p>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="title" class="col-sm-2 col-form-label">Remarks</label>
                                    <div class="col-sm-10">
                                        <p>{{ $testimonial->remarks }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="title" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                @if ($testimonial->image)
                                    <a href="{{ asset('uploads/testimonials/' . $testimonial->image) }}" target="_blank">
                                        <div class="img-wrapper">
                                            <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}"
                                                width="200px">
                                        </div>
                                    </a>
                                @else
                                    <strong>No image</strong>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="legend-border">Website Display Options</legend>
                    <div class="row-auto">
                        <div class="col-md-6">
                            <p><strong> Order: </strong><label class="label label-info">{{ $testimonial->order }}</label>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <strong>Publish status: </strong>
                                <label for=""
                                    class="label label-{{ $testimonial->status ? 'success' : 'warning' }}">
                                    {{ $testimonial->status == 1 ? 'Publish' : 'Draft' }}
                                </label>
                            </p>
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
