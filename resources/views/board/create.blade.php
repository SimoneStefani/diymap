@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" id="invite-user">Invite</a>
    <div id="map"></div>
    <div class="overlay-circle"></div>
    <form class="form-horizontal" name="create_form" role="form" method="POST" action="{{ url('/boards/'.$board->id.'/places') }}">
                    {{ csrf_field() }}
                    <div class="container-create-btn">
            <button type="submit" class="btn btn-resurrection">CREATE</button>
        </div>
                </form>
@endsection

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJEeEzm1BmEdB-98X9lGRdY78RJclvOHM&libraries=places&callback=initMap">
    </script>
@endsection