<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Resources\CarResource;

class SearchController extends Controller
{
    public function searchCars(Request $request)
    {
        $query = Car::query();

        //Pretrazuje se po imenu auta
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        //Paginacija samo auta koji zadovoljavaju uslov za name
        $page = $request->input('page', 1);
        $perPage = 1;

        $cars = $query->orderBy('name')->paginate($perPage, ['*'], 'page', $page);

        if($cars->isEmpty()){
            return response()->json(['message' => 'There arent any cars that match your search criteria.'], 404);
        }
        return response()->json(['Current page: ' => $cars->currentPage(), 'Last page:' => $cars->lastPage(),
         'Cars that match your search criteria:' => CarResource::collection($cars)], 200);
    }
}
