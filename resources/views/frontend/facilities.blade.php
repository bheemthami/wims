@extends('layouts.frontend.app')

@section('title', 'Facilities')

@section('content')

<div class="pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Facilities we provide</h1>
                    </div>
                </div>
            </div>
        </div>

        @forelse($facilities as $key =>$facility)
        <div class="row mt-50 mb-50">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="custom-wrapper mb-30">
                    <div class="custom-thumb mb-25 photo-animate">
                        <img class="img img-responsive" src="{{ asset('uploads/media/'.$facility->images[0]->image)}}" alt="No Image">
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="custom-content mb-30">
                    <h3 class="section-header-color"> {{ $facility->title}}</h3>
                    <p>{!! $facility->description !!}</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="custom-wrapper mb-30">
                    <div class="custom-thumb mb-25 photo-animate">
                        @if($facility->images[1])
                        <img class="img img-responsive" src="{{ asset('uploads/media/'.$facility->images[1]->image)}}" alt="No Image">
                        @else
                        <img class="img img-responsive" src="{{ asset('uploads/media/'.$facility->images[0]->image)}}" alt="No Image">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="row">
            <div class="col-xl-12 col-lg-12 text-center">
                NO DATA
            </div>
        </div>
        @endforelse

    </div>
</div>

@endsection
