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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
