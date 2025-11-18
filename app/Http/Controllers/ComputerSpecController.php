<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComputerSpecRequest;
use App\Http\Requests\UpdateComputerSpecRequest;
use App\Models\ComputerSpec;

class ComputerSpecController extends Controller
{
    public function index()
    {
        return ComputerSpec::all();
    }

    public function store(StoreComputerSpecRequest $request)
    {
        return ComputerSpec::create($request->all());
    }

    public function show(ComputerSpec $id)
    {
        return $id;
    }

    public function update(UpdateComputerSpecRequest $request, ComputerSpec $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(ComputerSpec $id)
    {
        return $id->delete();
    }

    public function getByComputerId(int $computer_id)
    {
        $specs = ComputerSpec::where('computer_id', $computer_id)->get();

        if ($specs->isEmpty()) {
            return response()->json([
                'message' => 'Specifications not found for this computer'
            ], 404);
        }

        return $specs;
    }
}
