<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;

class FoodController extends Controller
{
    public function index()
    {
        return Food::all();
    }

    public function store(StoreFoodRequest $request)
    {
        return Food::create($request->all());
    }

    public function show(Food $id)
    {
        return $id;
    }

    public function update(UpdateFoodRequest $request, Food $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(Food $id)
    {
        return $id->delete();
    }

    public function getByClubId($club_id)
    {
        return Food::where('club_id', $club_id)
            ->select('id', 'name', 'type', 'price', 'count', 'path_to_img')
            ->get();

    }
}
