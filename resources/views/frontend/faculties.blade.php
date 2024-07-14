@extends('layouts.frontend.app')

@section('title', 'Faculties')

@section('content')

<div class="pt-70 pb-70">
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
        <h3 class="primary-color">{{$faculty['title']}}</h3>
        <hr style=" border-bottom: 1px solid #8a8a8a;" />
        <div class="row justify-content-center">
            @forelse($faculty['officials'] as $key=>$official)
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
            @endforelse
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
