@extends('layouts.frontend.app')

@section('title', 'Our Faculty Members')

@section('content')

<div class="pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Our Faculty Members</h1>
                    </div>
                </div>
            </div>
        </div>

        @forelse($faculties as $faculty)
        <div class="faculty-wrapper"></div>
        <h3 class="text-center mb-20">{{$faculty['title']}}</h3>
        <div class="row justify-content-center faculty-content">
            <div class="officials">
                @forelse($faculty['officials'] as $key=>$official)
                <div class="official-item">
                    <div class="official-item-img">
                        @if(file_exists(public_path('uploads/officials/'.$official->image)) && $official->image)
                        <img src="{{ asset('uploads/officials/'.$official->image) }}" alt="Image" class="img img-responsive img-fluid" width="200">
                        @else
                        <img src="{{ asset('uploads/officials/official-default.jpeg') }}" alt="Image" class="img img-responsive img-fluid" width="200">
                        @endif
                    </div>
                    <p class="mt-1 mb-0 official-item-name">{{$official->first_name}} {{$official->last_name}}</p>
                    <h5 class="official-item-designation m-0">{{$official->designation->name}}</h5>
                    @if($official->mobile)
                    <p class="m-0 official-item-phone">{{$official->mobile}}</p>
                    @endif
                    @if($official->email)
                    <p class="m-0 official-item-email">{{$official->email}}</p>
                    @endif
                </div>
                @empty
                <div class="official-item">
                    <div>
                        <img src="{{ asset('uploads/officials/official-default.jpeg') }}" alt="Advertisement" class="img img-responsive img-fluid" width="200">
                    </div>
                    <h5 class="m-0">Name</h5>
                    <h4 class="m-0">Designation</h4>
                    <p class="m-0"> <i class="fa fa-phone me-1"></i>contact</p>
                    <p class="m-0"> <i class="fa fa-envelope me-1"></i> email/p>
                </div>
                @endforelse

            </div>

            <!-- @forelse($faculty['officials'] as $key=>$official)
            <div class="col-lg-3 col-md-3 mb-3">
                <div class="official-wrapper">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid" src="{{asset('uploads/officials/'.$official->image)}}" alt="No Image" width="200">
                    </div>
                    <div class="pt-2 text-center">
                        <h6 class="m-0 fw-bold text-primary">{{ $official->first_name }} {{ $official->middle_name }} {{ $official->last_name }}</h6>
                        <p class="mb-10 fw-bold">{{ $official->designation->name}}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-3">
                <p>No Data</p>
            </div>
            @endforelse -->
        </div>
        @empty
        <div class="row justify-content-center">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Data Not Found!</h1>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection