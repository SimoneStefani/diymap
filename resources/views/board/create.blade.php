@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">            
            <h3>Search</h3>

                <form class="form-horizontal" name="create_form" role="form" method="POST" action="{{ url('/boards/'.$board->id.'/places') }}">
                    {{ csrf_field() }}
                    <input type="text" value="" name="name" placeholder="name" />
                    <input type="text" value="" name="long" placeholder="long"/>
                    <input type="text" value="" name="lati" placeholder="lati"/>
                    <input type="text" value="" name="radius" placeholder="radius"/>
                    {{-- <input type="text" value="" name="ismain" placeholder="ismain"/> --}}
                    <div class="button-wrapper">
                        <button class="btn btn-large blue" type="submit" name="action">add</button>
                    </div>
                </form>

        </div>
    </div>
</div>
@endsection