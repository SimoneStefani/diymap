@extends('layouts.app')

@section('navbar-left')
	<div class="navbar-brand pull-left">
	    <button onclick="window.location.href='/boards'" class="btn btn-nav" type="button">
	        <i class="fa fa-arrow-left" aria-hidden="true"></i>
	    </button>
	</div>
@endsection

@section('navbar')
	<div class="navbar-brand pull-right">
		<button onclick="window.location.href='#'" class="btn btn-nav" type="button">
		<i class="fa fa-plus" aria-hidden="true"></i>
		</button>
	</div>
@endsection

@section('content')
    <a class="btn btn-primary" id="invite-user">Invite</a>
    <div id="map" data-lat="{{ $location->lati }}" data-lng="{{ $location->long }}" data-radius="{{ $location->radius }}"></div>
    <div class="canvas-title canvas-title-inboard">{{ $location->name }}</div>
    <div class="overlay-circle"></div>
@endsection