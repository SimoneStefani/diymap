@extends('layouts.app')

@section('navbar-left')
    <div class="navbar-brand pull-left">
        <button onclick="window.location.href='/boards'" class="btn btn-nav" type="button">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </button>
    </div>
@endsection

@section('navbar')
@endsection

@section('content')
    <div id="map" data-lat="{{ $lat }}" data-lng="{{ $lng }}"></div>
    <div class="overlay-circle"></div>
    <form class="form-horizontal" name="create_form" role="form" method="POST" action="{{ url('/boards/'.$board->id.'/places') }}">
        {{ csrf_field() }}
        <input id="lati" type="hidden" name="lati" value="{{ $lat }}">
        <input id="long" type="hidden" name="long" value="{{ $lng }}">
        <div class="container-create-btn">
            <button type="submit" class="btn btn-resurrection">CREATE</button>
        </div>
    </form>
@endsection