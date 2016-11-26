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
    	        <input type="text" value="" name="title" class="form-control form-nav" placeholder="Where you want to meet?" autocomplete="off" autofocus>
    	        <button class="btn btn-form-nav" type="submit" name="action"><i class="fa fa-search" aria-hidden="true"></i></button>
    	    </div>
    	</form>

</div>
@endsection
