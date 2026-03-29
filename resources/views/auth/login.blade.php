@extends('layouts.app')
@section('title', 'User Login')
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

            {{ html()->form('POST', route('login'))->id('login-form')->open() }}

            <div class="form-group has-feedback">
                {{ html()->email('email', old('email'))->class('form-control')->placeholder('Email')->autofocus() }}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>
            <div class="form-group has-feedback">
                {{ html()->password('password')->class('form-control')->placeholder('Password') }}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <div class="col-xs-8">
                    <a href="{{ route('password.request') }}" class="btn btn-link btn-block">Forgot Password?</a>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
