@extends('layouts.app')

@section('content')
    <h1>{{$board->title}}</h1>
    <input id="input" type="text">

    <div id="map" data-lat="{{ $location->lati }}" data-lng="{{ $location->long }}"></div>
@endsection

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJEeEzm1BmEdB-98X9lGRdY78RJclvOHM&libraries=places&callback=initMap">
    </script>
@endsection
