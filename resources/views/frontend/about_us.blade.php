@extends('layouts.frontend.app')

@section('title','About Us')

@section('content')
<!-- about us content -->
<div id="about" class="about-area pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">{{ $about->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="about-title-section about-title-section-2">
                    <p>{!! $about->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about us content - end -->
@endsection