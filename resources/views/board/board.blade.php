@extends('layouts.app')

@section('content')
    <div id="map"></div>
@endsection

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJEeEzm1BmEdB-98X9lGRdY78RJclvOHM&callback=initMap">
    </script>
@endsection