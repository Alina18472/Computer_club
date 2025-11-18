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

    public function show(Computer $id)
    {
        return $id;
    }

    public function update(UpdateComputerRequest $request, Computer $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(Computer $id)
    {
        return $id->delete();
    }
}
