@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">            
            <h3>Search</h3>

                <form class="form-horizontal" name="create_form" role="form" method="POST" action="{{ url('/boards') }}">
                    {{ csrf_field() }}
                    <div class="button-wrapper">
                        <input type="text" value="" name="title" />
                        <button class="btn btn-large blue" type="submit" name="action">create</button>
                    </div>
                </form>

        </div>
    </div>
</div>
@endsection