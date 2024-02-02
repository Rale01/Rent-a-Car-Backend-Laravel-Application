<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Car;
use App\Http\Resources\CarResource;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return CarResource::collection($cars);
    }

    //vrati auto po idu
    public function show($id)
    {
        $cars = Car::findOrFail($id);
        return new CarResource($cars);
    }
    
      //objavljivanje novog auta
      public function store(Request $request)
      {

         //ADMIN
         $isAdmin = Auth::user()->isAdmin;
         //validacija koja sve polja moraju da se unesu
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'description' => 'required',
          //dozvoljeni formati za sliku
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'price' => 'required',
          'rentTimeInDays' => 'required',
          'VIN' => 'required',
          'fuelType' => 'required',
          'gearType' => 'required',
          'properties' => 'required',
          'registration' => 'required',
          'car_type_id' => 'required',
      ]);
 
      if ($validator->fails()) {
          return response()->json($validator->errors());
      }

      if (!$isAdmin) {
        return response()->json(['error' => 'Unauthorized: This is an administrative function!'], 403);
    }

      //generisanje imena slike
      $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
 
      $car = new Car();
      $car->name = $request->name;
      $car->description = $request->description;
      $car->image = $imageName;
      $car->price = $request->price;
      $car->rentTimeInDays = $request->rentTimeInDays;
      $car->VIN = $request->VIN;
      $car->fuelType = $request->fuelType;
      $car->gearType = $request->gearType;
      $car->properties = $request->properties;
      $car->registration = $request->registration;
      $car->car_type_id = $request->car_type_id;
 
      //cuva se taj novi auto
      $car->save();
 
      //cuvanje slike u folderu storage
      Storage::disk('public')->put($imageName, file_get_contents($request->image));
 
      return response()->json(['Successfuly created a new car.',
           new CarResource($car)]);
      }
 
      //azuriranje auta
      public function update(Request $request, $id)
      {

        //ADMIN
        $isAdmin = Auth::user()->isAdmin;


          $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            //dozvoljeni formati za sliku
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'rentTimeInDays' => 'required',
            'VIN' => 'required',
            'fuelType' => 'required',
            'gearType' => 'required',
            'properties' => 'required',
            'registration' => 'required',
            'car_type_id' => 'required',
 
          ]);
 
          if ($validator->fails()) {
              return response()->json($validator->errors());
          }

          if (!$isAdmin) {
            return response()->json(['error' => 'Unauthorized: This is an administrative function!'], 403);
        }
 
          $car = Car::find($id);
          if(!$car){
            return response()->json([
              'message'=>'The specific car doesent exist in database.'
            ],404);
          }
 
          //menjanje unesenih vrednosti
            $car->name = $request->name;
            $car->description = $request->description;
            $car->price = $request->price;
            $car->rentTimeInDays = $request->rentTimeInDays;
            $car->VIN = $request->VIN;
            $car->fuelType = $request->fuelType;
            $car->gearType = $request->gearType;
            $car->properties = $request->properties;
            $car->registration = $request->registration;
            $car->car_type_id = $request->car_type_id;
 
          if($request->image) {
              // Public storage
              $storage = Storage::disk('public');
 
              // Brisanje stare slike
              if($storage->exists($car->image))
                  $storage->delete($car->image);
 
              //generisanje imena slike 
              $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
              //cuva se nova image
              $car->image = $imageName;
 
              // Image save in public folder
              $storage->put($imageName, file_get_contents($request->image));
          }
 
          // Update auta
          $car->save();
 
          return response()->json(['The car has successfuly been altered.', new CarResource($car)]);
      }

      //brisanje auta
     public function destroy($id)
     {
          // Detail 
          $car = Car::find($id);
          if(!$car){
            return response()->json([
               'message'=>'The specific car doesent exist in database.'

            ],404);
          }

          //ADMIN
        $isAdmin = Auth::user()->isAdmin;

        if (!$isAdmin) {
          return response()->json(['error' => 'Unauthorized: This is an administrative function!'], 403);
      }

          // Public storage
          $storage = Storage::disk('public');

          // Brisanje slike iz foldera storage
          if($storage->exists($car->image))
              $storage->delete($car->image);

          // Brisanje auta
          $car->delete();

          // Return Json Response
          return response()->json([
              'message' => "Successfuly deleted a car."
          ],200);
     }

}
