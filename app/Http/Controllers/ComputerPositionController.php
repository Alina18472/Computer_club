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

    public function show(ComputerPosition $computerPosition)
    {
        return $computerPosition;
    }

    public function update(UpdateComputerPositionRequest $request, ComputerPosition $computerPosition)
    {
        $computerPosition->update($request->all());
        return $computerPosition;
    }

    public function destroy(ComputerPosition $computerPosition)
    {
        return $computerPosition->delete();
    }

    public function getByClubId($club_id)
    {
        $positions = ComputerPosition::where('club_id', $club_id)
            ->select('id', 'number', 'coefficient', 'position_x', 'position_y', 'room_id')
            ->get();

        return $positions;
    }

    public function getByRoomId($room_id)
    {
        $positions = ComputerPosition::where('room_id', $room_id)
            ->select('id', 'number', 'coefficient', 'position_x', 'position_y', 'club_id')
            ->get();

        return $positions;
    }
}
