@extends('layouts.frontend.app')

@section('title', 'Faculties')

@section('content')

<div class="pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Our Programs</h1>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            @forelse($programs as $program)
            <div class="col-xl- col-lg-4 col-md-6">
                <div class="courses-wrapper mb-30">
                    <div class="courses-thumb">
                        <a href="{{ route('program-details',$program->slug)}}"><img src="{{ asset('uploads/programs/'.$program->image)}}" alt=" NO IMAGE "></a>
                    </div>
                    <div class="courses-content courses-content-2 text-center">
                        <div class="courses-heading text-center">
                            <h1><a href="{{ route('program-details',$program->slug)}}">{{$program->title}}</a></h1>
                        </div>
                        <div class="courses-icon text-center">
                            <div class="courses-single-icon courses-single-icon-2">
                                <span class="ti-user"></span>
                                <span class="seat">Quota</span>
                                <span class="user-number">{{$program->quota}}</span>
                            </div>
                            <div class="courses-single-icon courses-single-icon-2">
                                <i class="fa fa-clock"></i>
                                <span class="price">Duration</span>
                                <span class="user-number">{{$program->duration}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-xl-8 col-lg-8 col-md-6">
                {!! $program->description !!}
             </div>
            @empty
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="courses-wrapper mb-30 text-center">
                    <p>NO DATA</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection