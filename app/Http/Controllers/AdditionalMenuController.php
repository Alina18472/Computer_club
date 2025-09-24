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

    public function show(AdditionalMenu $additionalMenu)
    {
        return $additionalMenu;
    }

    public function update(UpdateAdditionalMenuRequest $request, AdditionalMenu $additionalMenu)
    {
        $additionalMenu->update($request->all());
        return $additionalMenu;
    }

    public function destroy(AdditionalMenu $additionalMenu)
    {
        return $additionalMenu->delete();
    }
}
