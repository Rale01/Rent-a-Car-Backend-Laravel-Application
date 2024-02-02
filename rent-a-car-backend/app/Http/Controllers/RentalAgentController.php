<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\RentalAgentResource;
use App\Models\RentalAgent;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class RentalAgentController extends Controller
{
    //svi rentalagenti
    public function index()
    {
        $rentalagents = RentalAgent::all();
        return RentalAgentResource::collection($rentalagents);
    }

    //rentalagent na osnovu id-a
    public function show($id)
    {
        $rentalagent = RentalAgent::findOrFail($id);
        return new RentalAgentResource($rentalagent);
    }

    //nov rentalagent
    public function store(Request $request)
    {
        //ADMIN
        $isAdmin = Auth::user()->isAdmin;

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'city' => 'required',
        'address' => 'required',
        'email' => 'required',
        'telephone' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors());
    }

    if (!$isAdmin) {
        return response()->json(['error' => 'Unauthorized: This is an administrative function!'], 403);
    }

    $rentalagent = new RentalAgent();
    $rentalagent->name = $request->name;
    $rentalagent->city = $request->city;
    $rentalagent->address = $request->address;
    $rentalagent->email = $request->email;
    $rentalagent->telephone = $request->telephone;

    $rentalagent->save();

    return response()->json(['You have successfuly created a new rental agent!',
         new RentalAgentResource($rentalagent)]);
    }

    //azuriranje rentalagenta
    public function update(Request $request, $id)
    {
         //ADMIN
        $isAdmin = Auth::user()->isAdmin;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'email' => 'required',
            'telephone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if (!$isAdmin) {
            return response()->json(['error' => 'Unauthorized: This is an administrative function!'], 403);
        }

        $rentalagent = RentalAgent::findOrFail($id);

        $rentalagent->name = $request->name;
        $rentalagent->city = $request->city;
        $rentalagent->address = $request->address;
        $rentalagent->email = $request->email;
        $rentalagent->telephone = $request->telephone;

        $rentalagent->save();

        return response()->json(['The specific rental agent is successfuly altered!', new RentalAgentResource($rentalagent)]);
    }

    //brisanje rentalagenta
    public function destroy($id)
    {
         //ADMIN
         $isAdmin = Auth::user()->isAdmin;

         if (!$isAdmin) {
            return response()->json(['error' => 'Unauthorized: This is an administrative function!'], 403);
        }
        
        $rentalagent = RentalAgent::findOrFail($id);
        $rentalagent->delete();
        return response()->json('Successfuly deleted a specific rental agent!');
    }
}