@extends('layouts.frontend.app')

@section('title', 'Training We Offer')

@section('content')

<div class="pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Trainings We Offer</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-10 col-lg-10 offset-xl-1 offset-lg-1">
                <table class="table table-hover table-bordered ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Quota</th>
                            <th>Duration</th>
                            <th>Eligibility</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td colspan="6" style="color: #002147"><strong> {{ $category['trainings'][0]->trainingType->title }} - {{ $category['title'] }}</strong> </td>
                        </tr>
                        @forelse($category['trainings'] as $key=>$training)
                        <tr>
                            <td>
                                <span class="frontend-img-wrapper">
                                    <img class="frontend-img" src="{{asset('uploads/trainings/'.$training->image)}}" alt="NO PHOTO">
                                </span>
                            </td>
                            <td>
                                <strong> {{ $training->title}} </strong>
                            </td>
                            <td>{{ $training->quota }}</td>
                            <td>{{ $training->duration }}</td>
                            <td>{{ $training->eligibility }}</td>
                            <td></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">NO DATA</td>
                        </tr>
                        @endforelse
                        <tr>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">NO DATA</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection