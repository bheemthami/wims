@extends('layouts.frontend.app')

@section('title', 'Contact Us')

@section('content')
    <div class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-10 offset-md-1 ml-md-auto">
                    <div class="contact-info-text">
                        <div class="section-title mb-20">
                            <div class="section-title-heading mb-10">
                                <h1>Contact Info</h1>
                            </div>
                            <div class="section-title-para">
                                @if ($contactUs)
                                    <p>{{ $contactUs->summary }}</p>
                                @else
                                    <p>We highly welcome your suggesttions. Please, keep in touch with us.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="contact-info mb-50 wow fadeInRight" data-wow-delay=".3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInRight;">
                        <ul>
                            <li>
                                <div class="contact-icon">
                                    <i class="ti-headphone"></i>
                                </div>
                                <div class="contact-text">
                                    <h5>Call Us</h5>
                                    <span>{{ $settings->phone }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon">
                                    <i class="ti-email"></i>
                                </div>
                                <div class="contact-text">
                                    <h5>Email Us</h5>
                                    <span>{{ $settings->email }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon">
                                    <i class="ti-location-pin"></i>
                                </div>
                                <div class="contact-text">
                                    <h5>Location</h5>
                                    <span>{{ $settings->office_address }}, {{ $settings->municipality }},
                                        {{ $settings->district_name }} District, {{ $settings->province_name }}, Province,
                                        Nepal</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-10 offset-md-1 ml-md-auto">
                    <div class="events-details-form faq-area-form mb-30 p-0">
                        <form id="visitor_query_form" method="POST">
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="events-form-title mb-25">
                                        <h2>Do You Have Any Questions</h2>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <input id="name" class="visitor-query" placeholder="Name :" type="text"
                                        name="name">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <input id="email" class="visitor-query" placeholder="Email :" type="text"
                                        name="email">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <input id="subject" class="visitor-query" placeholder="Subject :" type="text"
                                        name="subject">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <input id="phone" class="visitor-query" placeholder="Phone :" type="text"
                                        name="phone">
                                </div>
                                <div class="col-xl-12">
                                    <textarea id="message" class="visitor-query" cols="30" rows="10" placeholder="Message :" name="message"></textarea>
                                </div>
                                <div class="col-xl-12">
                                    <div class="faq-form-btn events-form-btn">
                                        <button id="submit-now" class="btn m-0" type="submit">submit now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pb-50">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8  col-sm-12  col-sm-12  col-xs-12">
                @if ($embeddings['google_map'])
                    <div class="google-map">
                        {!! $embeddings['google_map']->iframe !!}
                    </div>
                @else
                    <div class="border rounded p-3 text-center">
                        <p class="text-center m-0">Google Map Not available</p>
                    </div>
                @endif
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4  col-sm-12  col-sm-12  col-xs-12">
                @if ($embeddings['facebook'])
                    <div class="facebook-page-block">
                        {!! $embeddings['facebook']->iframe !!}
                    </div>
                @else
                    <div class="border rounded p-3 text-center">
                        <p class="text-center m-0">Facebook Page Not available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#visitor_query_form').on('submit', function(e) {
                e.preventDefault();

                form_data = {
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'phone': $('#phone').val(),
                    'subject': $('#subject').val(),
                    'message': $('#message').val(),
                }

                if (form_data.name == "" | form_data.name == undefined) {
                    $('#name').css('border-color', 'red')
                }

                if (form_data.email == "" | form_data.email == undefined) {
                    $('#email').css('border-color', 'red')
                }

                if (form_data.phone == "" | form_data.phone == undefined) {
                    $('#phone').css('border-color', 'red')
                }

                if (form_data.subject == "" | form_data.subject == undefined) {
                    $('#subject').css('border-color', 'red')
                }

                if (form_data.message == "" | form_data.message == undefined) {
                    $('#message').css('border-color', 'red')
                }


                if (form_data.name != "" | form_data.email != "" | form_data.phone != "" | form_data
                    .subject != "" | form_data.message != "") {
                    $(document).find('#submit-now').html('submitting...')

                    var baseUrl = "<?php echo url('/collect-visitor-queries'); ?>";
                    $.ajax({
                        url: baseUrl,
                        type: 'POST',
                        data: {
                            ...form_data,
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status === 'ok') {
                                $(document).find('#submit-now').html(
                                    'Submitted! Please check your mail.')
                                $(document).find('#name').val('');
                                $(document).find('#email').val('');
                                $(document).find('#phone').val('');
                                $(document).find('#subject').val('');
                                $(document).find('#message').val('');
                            } else {
                                if (response?.email.length > 0) {
                                    $(document).find('#submit-now').html('Resubmit')
                                    $('#email').css('border-color', 'red')
                                }
                            }
                        },
                        error: function() {
                            $(document).find('#submit-now').html('Failed! Try again later.')
                        },

                    });
                }
            })
        });
    </script>
@endsection
