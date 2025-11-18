<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdditionalMenuRequest;
use App\Http\Requests\UpdateAdditionalMenuRequest;
use App\Models\AdditionalMenu;

class AdditionalMenuController extends Controller
{
    public function index()
    {
        return AdditionalMenu::all();
    }

    public function store(StoreAdditionalMenuRequest $request)
    {
        return AdditionalMenu::create($request->all());
    }

    public function show(AdditionalMenu $id)
    {
        return $id;
    }

    public function update(UpdateAdditionalMenuRequest $request, AdditionalMenu $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(AdditionalMenu $id)
    {
        return $id->delete();
    }
}
