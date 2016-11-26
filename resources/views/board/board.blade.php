@extends('layouts.app')

@section('content')
    <input id="input" type="text">

    <a class="btn btn-primary" id="invite-user">Invite</a>

    <div id="map" data-lat="{{ $location->lati }}" data-lng="{{ $location->long }}"></div>

        <div class="overlay-circle"></div>

        <div class="container-create-btn">
            <button type="submit" class="btn btn-resurrection">CREATE</button>
        </div>
@endsection

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJEeEzm1BmEdB-98X9lGRdY78RJclvOHM&libraries=places&callback=initMap">
    </script>
@endsection
