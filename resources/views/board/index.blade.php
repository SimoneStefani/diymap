@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Index page</h3>
            @foreach($ownedBoards as $owned)
                <p><a href="{{ url('/boards/'.$owned->id) }}">{{ $owned->title }}</a></p>
            @endforeach
        </div>
    </div>
</div>
<div>
    <p><a href="{{ url('/boards/create') }}">+</a></p>
</div>
@endsection
