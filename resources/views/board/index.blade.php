@extends('layouts.app')

@section('navbar')
	<div class="navbar-brand pull-right">

	<a class="btn btn-nav" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	    <i class="fa fa-sign-out" aria-hidden="true"></i>
	</a>
	<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
	    {{ csrf_field() }}
	</form>

	</div>
@endsection

@section('content')
<div class="container canvas-container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="canvas-title">Boards</div>
            @if(isset($ownedBoards))
            @foreach($ownedBoards as $owned)
                <div class="board-card">
                    <div class="board-card-img"></div>
                    <a href="{{ url('/boards/'.$owned->id) }}">
                    <div class="board-card-title">{{ $owned->title }}</div>
                    </a>
                </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="search-container">
    	<form class="input-group" name="create_form" role="form" method="POST" action="{{ url('/boards') }}">
    	    {{ csrf_field() }}
    	    <div class="button-wrapper">
    	        <input id="where" type="text" value="" name="title" class="form-control form-nav" placeholder="Where you want to meet?" autocomplete="off" autofocus>
                <input id="lati" type="hidden" name="lati">
                <input id="long" type="hidden" name="long">
    	        <button class="btn btn-form-nav" type="submit" name="action"><i class="fa fa-search" aria-hidden="true"></i></button>
    	        <div class="autofill-results"></div>
    	    </div>
    	</form>
    </div>
@endsection
