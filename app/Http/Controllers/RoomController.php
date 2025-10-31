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

    public function show(Room $room)
    {
        return $room;
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->all());
        return $room;
    }

    public function destroy(Room $room)
    {
        return $room->delete();
    }

    public function getByClubId($club_id)
    {
        $rooms = Room::where('club_id', $club_id)
            ->select('id', 'name')
            ->get();

        return $rooms;
    }

}
