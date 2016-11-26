<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class LocationController extends Controller
{
    public function store(Request $request) 
    {
        // If fails, throws 422
        $this->validate($request, [
            'long' => 'required|numeric',
            'lati' => 'required|numeric'
        ]);

        $newLocation = Auth::user()->locations()->create([
            'long' => $request->long,
            'lati' => $request->lati
        ]);

        return json_encode($newLocation);
    }

    public function index() 
    {
        if(!Auth::check()) 
        {
            throw new AccessDeniedHttpException("User not authorised!");
        }

        return json_encode(Auth::user()->locations);
    }

    public function update(string $locationId) 
    {
        if(!Auth::check()) 
        {
            throw new AccessDeniedHttpException("User not authorised!");
        }

        // If fails, throws 422
        $this->validate($request, [
            'long' => 'required|numeric',
            'lati' => 'required|numeric'
        ]);

        $location = Location::where('id', $locationId)->firstOrFail();

        $location->long = $request->long;
        $location->lati = $request->lati;
        $location->save();

        return json_encode($location);
    }

    public function show(string $locationId) 
    {

        if(!Auth::check()) 
        {
            throw new AccessDeniedHttpException("User not authorised!");
        }

        return json_encode(Location::where('id', $locationId)->firstOrFail());
    }

    public function destroy(string $locationId) 
    {
        if(!Auth::check()) 
        {
            throw new AccessDeniedHttpException("User not authorised!");
        }

        $location = Location::where('id', $locationId)->firstOrFail();

        $location->delete();

        return json_encode($location);
    }

}
