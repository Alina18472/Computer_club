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

    public function show(ComputerSpec $computerSpec)
    {
        return $computerSpec;
    }

    public function update(UpdateComputerSpecRequest $request, ComputerSpec $computerSpec)
    {
        $computerSpec->update($request->all());
        return $computerSpec;
    }

    public function destroy(ComputerSpec $computerSpec)
    {
        return $computerSpec->delete();
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
