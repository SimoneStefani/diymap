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
        <button id="invite-user" data-user="{{ $board->id }}" class="btn btn-nav" type="button">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </button>
	</div>
@endsection

@section('content')
    <div id="map" data-lat="{{ $location->lati }}" data-lng="{{ $location->long }}" data-radius="{{ $location->radius }}" data-board="{{ $board->id }}"></div>
    <div class="canvas-title canvas-title-inboard">{{ $location->name }}</div>
    <div class="overlay-circle"></div>
	<div class="user-ribbon-wrapper">
	    <div class="user-ribbon">
        @foreach($board->participants as $part)
	    	<div class="user"><img src="/uploads/avatars/{{$loop->iteration}}.svg"></div>
        @endforeach
	    </div>
	</div>
@endsection