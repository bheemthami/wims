@extends('layouts.admin.app')

@section('title', 'Document > Edit')

@section('content')

    <!-- Content Header (Document header) -->
    <section class="content-header">
        <h1> Documents</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('documents.index') }}"> Documents</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit</h3>
                <div class="box-tools pull-right">
                    <p style="color:red;">Fileds with (*) are compulsory.</p>
                </div>
            </div>
            <div class="box-body">
                {{ html()->modelForm($document, 'PATCH', route('documents.update', $document->id))->attribute('enctype', 'multipart/form-data')->open() }}
                @include('site_modules.documents.partial.form')
                <div class="form-inline">
                    <div class="pull pull-right">
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">Submit</button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger pull-right" href="{{ route('documents.index') }}">Cancel</a>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#date').datepicker({
                "format": 'yyyy-mm-dd'
            }).datepicker("setDate", 'now');

        });
    </script>
@endsection
