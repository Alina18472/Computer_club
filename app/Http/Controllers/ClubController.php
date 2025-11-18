<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Models\Club;

class ClubController extends Controller
{
    public function index()
    {
        return Club::all();
    }

    public function store(StoreClubRequest $request)
    {
        return Club::create($request->all());
    }

    public function show(Club $id)
    {
        return $id;
    }

    public function update(UpdateClubRequest $request, Club $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(Club $id)
    {
        return $id->delete();
    }
}
