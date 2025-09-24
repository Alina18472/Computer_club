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

    public function show(Tariff $tarif)
    {
        return $tarif;
    }

    public function update(UpdateTariffRequest $request, Tariff $tarif)
    {
        $tarif->update($request->all());
        return $tarif;
    }

    public function destroy(Tariff $tarif)
    {
        return $tarif->delete();
    }
}
