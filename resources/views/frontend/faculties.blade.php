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

        <div class="row">
            <div class="col-xl-10 col-lg-10 offset-xl-1 offset-lg-1">
                <table class="table table-hover table-bordered ">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Full Name</th>
                            <th>Designation</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faculties as $faculty)
                        <tr>
                            <td colspan="6" style="color: #002147"><strong> {{ $faculty['title'] }} </strong> </td>
                        </tr>
                        @forelse($faculty['officials'] as $key=>$official)
                        <tr>
                            <td>{{ ++$key}}</td>
                            <td>
                                <span class="frontend-img-wrapper">
                                <img class="frontend-img" src="{{asset('uploads/officials/'.$official->image)}}" alt="NO PHOTO">
                                <p> <strong> {{ $official->first_name }}  {{ $official->middle_name }}  {{ $official->last_name }} </strong></p>
                                </span>
                            </td>
                            <td>{{ $official->designation->name }}</td>
                            <td>{{ $official->mobile }}</td>
                            <td>{{ $official->email }}</td>
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