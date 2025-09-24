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

    public function show(Food $food)
    {
        return $food;
    }

    public function update(UpdateFoodRequest $request, Food $food)
    {
        $food->update($request->all());
        return $food;
    }

    public function destroy(Food $food)
    {
        return $food->delete();
    }
}
