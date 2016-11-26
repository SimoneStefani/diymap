@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" id="invite-user">Invite</a>
    <div id="map" lat="-40" lng="140"></div>
    <div class="overlay-circle"></div>
    <form class="form-horizontal" name="create_form" role="form" method="POST" action="{{ url('/boards/'.$board->id.'/places') }}">
        {{ csrf_field() }}
        <div class="container-create-btn">
            <button type="submit" class="btn btn-resurrection">CREATE</button>
        </div>
    </form>
@endsection