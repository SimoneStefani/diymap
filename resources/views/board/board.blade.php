@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" id="invite-user">Invite</a>
    <div id="map" data-lat="{{ $location->lati }}" data-lng="{{ $location->long }}"></div>
    <div class="overlay-circle"></div>
@endsection