@extends('layouts.admin.app')

@section('title', 'Training > Create')

@section('content')
    <!-- Content Header (Training header) -->
    <section class="content-header">
        <h1> Training</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('trainings.index') }}"> Trainings</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create</h3>
                <div class="box-tools pull-right">
                    <p style="color:red;">Fileds with (*) are compulsory.</p>
                </div>
            </div>
            <div class="box-body">
                <form id="page-form" method="POST" action="{{ route('trainings.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('site_modules.trainings.partial.form')
                    <div class="form-inline">
                        <div class="pull pull-right">
                            <div class="form-group">
                                <button class="btn btn-success pull-right" type="submit">Submit</button>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-danger pull-right" href="{{ route('trainings.index') }}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('plugins/ckeditor5/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
                }
            }, {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
@endsection
