@extends('layouts.frontend.app')

@section('title',$page ? $page->title : 'Page Title')

@section('content')
<!-- about start -->
<div id="about" class="about-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4">
                <div class="about-right-img mb-30 img img-responsive">
                    @if($page && file_exists(public_path('uploads/pages/'.$page->image)))
                    <img src="{{asset('uploads/pages/'.$page->image)}}" alt="" width="230" height="auto">
                    @else
                    <img src="frontend/img/about/about-right.png" alt="">
                    @endif
                </div>
            </div>
            <div class="col-xl-8 col-lg-8">
                <div class="about-title-section mb-30">
                    <h1>{{$page ? $page->title : 'About Us'}}</h1>
                    <p>{!! $page ? $page->description : 'About Us - Description' !!}</p>
                    <a href="{{ route('index') }}" class="theme-btn blue-bg-border mt-20"><span class="btn-text">Home</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about end -->

@endsection