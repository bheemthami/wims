@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
    <div class="login-box" style="background-color: #31708f;">
        <div class="login-logo">
            <a href="{{ URL::to('') }}"><b>
                    <img style="margin-left: 130px;" class="image img-responsive"
                        src="{{ asset('uploads/setting/' . $settings['setting']->logo) }}" height="100" width="100"
                        alt="Favicon">
            </a>
            <p style="font-size: 20px">{{ $settings['setting']->office }}</p>
            <address style="font-size: 15px">{{ $settings['setting']->office_address }}</address>
        </div>
        <div class="login-box-body" style="background-color: #d9edf7">
            <p class="login-box-msg">{{ $settings['setting']->system_name }}</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            {{ html()->form('POST', route('password.email'))->id('forgot-password-form')->open() }}

            <div class="row {{ $errors->has('email') ? ' has-error' : '' }} form-group">
                <div class="col-md-12">
                    {{ html()->email('email')->class('form-control')->placeholder('Enter your email address')->id('email')->required() }}
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between alig-items-center gap-2">
                        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                        <a href="{{ route('login') }}" class="btn btn-link">Back to Login</a>
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
