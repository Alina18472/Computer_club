<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTariffRequest;
use App\Http\Requests\UpdateTariffRequest;
use App\Models\Tariff;

class TariffController extends Controller
{
    public function index()
    {
        return Tariff::all();
    }

    public function store(StoreTariffRequest $request)
    {
        return Tariff::create($request->all());
    }

    public function show(Tariff $id)
    {
        return $id;
    }

    public function update(UpdateTariffRequest $request, Tariff $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(Tariff $id)
    {
        return $id->delete();
    }
}
