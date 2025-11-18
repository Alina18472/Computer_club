<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComputerPositionRequest;
use App\Http\Requests\UpdateComputerPositionRequest;
use App\Models\ComputerPosition;

class ComputerPositionController extends Controller
{
    public function index()
    {
        return ComputerPosition::all();
    }

    public function store(StoreComputerPositionRequest $request)
    {
        return ComputerPosition::create($request->all());
    }

    public function show(ComputerPosition $id)
    {
        return $id;
    }

    public function update(UpdateComputerPositionRequest $request, ComputerPosition $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(ComputerPosition $id)
    {
        return $id->delete();
    }

    public function getByClubId($club_id)
    {
        return ComputerPosition::where('club_id', $club_id)
            ->select('id', 'number', 'coefficient', 'position_x', 'position_y', 'room_id')
            ->get();
    }

    public function getByRoomId($room_id)
    {
        return ComputerPosition::where('room_id', $room_id)
            ->select('id', 'number', 'coefficient', 'position_x', 'position_y', 'club_id')
            ->get();
    }

    public function getFreePositionsByClubIdAndRoomId(int $club_id, int $room_id){
        return ComputerPosition::where('club_id', $club_id)
            ->where('room_id', $room_id)
            ->whereDoesntHave('computers')
            ->get();
    }
}
