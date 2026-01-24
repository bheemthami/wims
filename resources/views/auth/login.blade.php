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

            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">

                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <div class="col-xs-8">
                        <a href="#" class="btn btn-link btn-block">Forgot Passward?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
