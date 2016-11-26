@extends('layouts.app')

@section('navbar')
@endsection

@section('content')
<div class="container">
    <div class="auth-container">
        <div class="auth-logo"></div>
        <form class="form-auth" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>

            <!-- <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
            </div> -->

            <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
            </div>
            <a href="{{ url('/register') }}">Register</a>  |  
            <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </form>
    </div>
</div>
@endsection

@section('google-maps')
@endsection