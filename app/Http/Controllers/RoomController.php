<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }

    public function store(StoreRoomRequest $request)
    {
        return Room::create($request->all());
    }

    public function show(Room $id)
    {
        return $id;
    }

    public function update(UpdateRoomRequest $request, Room $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(Room $id)
    {
        return $id->delete();
    }

    public function getByClubId($club_id)
    {
        return Room::where('club_id', $club_id)
            ->select('id', 'name')
            ->get();
    }

}
