@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/boards') }}">
                    {{ csrf_field() }}
                    <input id="title" type="text" name="title">
                    <div class="button-wrapper">
                        <button class="btn btn-large blue" type="submit" name="action">Create</button>
                    </div>
                </form>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/boards/1') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="button-wrapper">
                        <button class="btn btn-large blue" type="submit" name="action">Delete</button>
                    </div>
                </form>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/boards/2/places') }}">
                    {{ csrf_field() }}
                    <input id="name" type="text" name="name">
                    <input id="lati" type="text" name="lati">
                    <input id="long" type="text" name="long">
                    <div class="button-wrapper">
                        <button class="btn btn-large blue" type="submit" name="action">Add location</button>
                    </div>
                </form>


                <form class="form-horizontal" name="createLocationForm" role="form" method="POST" action="{{ url('/locations') }}">
                    {{ csrf_field() }}
                    <div class="button-wrapper">
                        <input type="numeric" value="" name="long" />
                        <input type="numeric" value="" name="lati" />
                        <button class="btn btn-large blue" type="submit" name="action">createLocation</button>
                    </div>
                </form>
                <form class="form-horizontal" name="deleteLocationForm" role="form" method="POST" action="{{ url('/locations/1') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="button-wrapper">
                        <button class="btn btn-large blue" type="submit" name="action">deleteLocation</button>
                    </div>
                </form>

                <form class="form-horizontal" name="updateUserLocation" role="form" method="POST" action="{{ url('/users/1/update-location') }}">
                    {{ csrf_field() }}
                    <div class="button-wrapper">
                        <input type="numeric" value="" name="long" />
                        <input type="numeric" value="" name="lati" />
                        <button class="btn btn-large blue" type="submit" name="action">updateUserLocation</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
