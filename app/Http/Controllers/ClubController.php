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

    public function show(Club $club)
    {
        return $club;
    }

    public function update(UpdateClubRequest $request, Club $club)
    {
        $club->update($request->all());
        return $club;
    }

    public function destroy(Club $club)
    {
        return $club->delete();
    }
}
