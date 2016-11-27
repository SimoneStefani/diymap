@extends('layouts.app')

@section('navbar')
@endsection

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="auth-container">
        <div class="auth-logo"></div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <form class="form-auth" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Send Password Reset Link
                </button>
            </div>
            <a href="{{ url('/login') }}">Login</a>  |  
            <a href="{{ url('/register') }}">Register</a>

        </form>
    </div>
</div>
@endsection

@section('google-maps')
@endsection