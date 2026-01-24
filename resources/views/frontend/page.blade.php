@extends('layouts.frontend.app')

@section('title', $page ? $page->title : 'Page Title')

@section('content')
    <!-- about start -->
    <div id="about" class="about-area pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="about-right-img mb-30 ">
                        @if ($page && file_exists(public_path('uploads/pages/' . $page->image)))
                            <img class="img img-responsive img-diagonal-border-radius"
                                src="{{ asset('uploads/pages/' . $page->image) }}" alt="">
                        @else
                            <img class="img img-responsive img-diagonal-border-radius"
                                src="frontend/img/about/about-right.png" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="section-title-heading mb-30">
                        <h1 class="primary-color">{{ $page ? $page->title : 'Page' }}</h1>
                    </div>
                    <div>
                        <p>{!! $page ? $page->description : 'Description' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about end -->

@endsection
