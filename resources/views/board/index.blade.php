@extends('layouts.app')

@section('content')
<div class="container canvas-container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="canvas-title">Boards</div>
            @foreach($ownedBoards as $owned)
                <p><a href="{{ url('/boards/'.$owned->id) }}">{{ $owned->title }}</a></p>
            @endforeach
            <div class="board-card">
            	<div class="board-card-img"></div>
            	<div class="board-card-title">Woah what a gathering</div>
            </div>
        </div>
    </div>
</div>
<div>
    <p><a href="{{ url('/boards/create') }}">+</a></p>
</div>
@endsection
