@extends('layouts.frontend.app')

@section('title','About Us')

@section('content')
<!-- slider-start -->
<div class="slider-area">
    <div class="page-title">
        <div class="single-slider slider-height slider-height-breadcrumb d-flex align-items-center" style="background-image: url({{ asset('uploads/pages/'.$about->image) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="slider-content slider-content-breadcrumb text-center">
                            <h1 class="white-color f-700">About Us</h1>
                            <nav class="text-center" aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('index')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider-end -->

<!-- about us content -->
<div id="about" class="about-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="about-title-section about-title-section-2 mb-30">
                    <h1>{{ $about->title }}</h1>
                    <p>{!! $about->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about us content - end -->
@endsection
