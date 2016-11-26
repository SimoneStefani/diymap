<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserLocationController extends Controller
{
    public function getUserLocation(string $userId) 
    {
        $locations = User::where('id', $userId)->firstOrFail()->locations();

        return json_encode($locations->first());
    }

    public function updateUserLocation(string $userId, Request $request)
    {
        $this->validate($request, [
            'long' => 'required|numeric',
            'lati' => 'required|numeric'
        ]);

        $user = User::where('id', $userId)->firstOrFail();
        $location = $user->locations()->first();

        if(is_null($location)) 
        {
            $updatedLocation = $user->locations()->create([
                'long' => $request->long,
                'lati' => $request->lati
            ]);
            $user->locations()->attach($updatedLocation, []);
            return json_encode($updatedLocation);
        } 
        else 
        {
            $location->long = $request->long;
            $location->lati = $request->lati;
            $location->save();
            return json_encode($location);  
        }       
    }
}
