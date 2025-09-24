<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;
use App\Models\Computer;

class ComputerController extends Controller
{
    public function index()
    {
        return Computer::all();
    }

    public function store(StoreComputerRequest $request)
    {
        return Computer::create($request->all());
    }

    public function show(Computer $computer)
    {
        return $computer;
    }

    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        $computer->update($request->all());
        return $computer;
    }

    public function destroy(Computer $computer)
    {
        return $computer->delete();
    }
}
