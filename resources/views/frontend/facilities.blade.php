@extends('layouts.frontend.app')

@section('title', 'Facilities')

@section('content')

<div class="pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Our Facilities</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($facilities as $key =>$facility)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="blog-wrapper mb-30">
                    <div class="blog-thumb mb-25 photo-animate">
                        <img src="{{ asset('uploads/facilities/'.$facility->image)}}" alt="" height="260" width="370">

                    </div>
                    <div class="blog-content">
                        <h5> <strong>    {{++$key}}. </strong> {{ $facility->title}}</h5>
                        <p>{{ substr($facility->summary,0,300) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-xl-12 col-lg-12 text-center">
                NO DATA
            </div>
            @endforelse  
        </div>
    </div>
</div>

@endsection