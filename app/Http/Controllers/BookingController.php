<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use Exception;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::all();
    }

    public function store(StoreBookingRequest $request)
    {
        return Booking::create($request->all());
    }

    public function show(Booking $id)
    {
        return $id;
    }

    public function update(UpdateBookingRequest $request, Booking $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(Booking $id)
    {
        return $id->delete();
    }

    public function getOrderedDatesFromComputerIdAndDay($computer_id, $day)
    {
        try {
            $date = Carbon::parse($day)->startOfDay();
        } catch (Exception) {
            return response()->json(['error' => 'Неверный формат даты. Используй формат YYYY-MM-DD.'], 400);
        }

        $ids = Booking::where('computer_id', $computer_id)
            ->whereDate('start_time', '<=', $date->copy()->endOfDay())
            ->whereDate('end_time', '>=', $date)
            ->select('id', 'start_time', 'end_time', 'status')
            ->get();

        return $ids;
    }

    public function getFullInfo($id)
    {
        $id = Booking::with([
            'computer.position.room.club'
        ])->find($id);

        if (!$id) {
            return response()->json(['error' => 'Бронирование не найдено'], 404);
        }

        $club = $id->computer->position->club ?? null;
        $room = $id->computer->position->room ?? null;

        return response()->json([
            'id' => $id->id,
            'computer_id' => $id->computer_id,
            'user_id' => $id->user_id,
            'code_id' => $id->code_id,
            'club_id' => $id->club_id,
            'start_time' => $id->start_time,
            'end_time' => $id->end_time,
            'minutes' => $id->minutes,
            'price_for_pc' => $id->price_for_pc,
            'price_for_additions' => $id->price_for_additions,
            'total_price' => $id->total_price,
            'status' => $id->status,
            'created_at' => $id->created_at,
            'updated_at' => $id->updated_at,
            'club' => $club ? [
                'address' => $club->address,
                'phone' => $club->phone,
            ] : null,
            'room' => $room ? [
                'name' => $room->name,
            ] : null,
        ]);
    }

    public function getBookingsByClubIdAndDate($club_id, $date)
    {
        $startOfDay = Carbon::parse($date)->startOfDay();
        $endOfDay   = Carbon::parse($date)->endOfDay();

        $bookings = Booking::query()
            ->where('club_id', $club_id)
            ->where('start_time', '<', $endOfDay)
            ->where('end_time',   '>', $startOfDay)
            ->select([
                'computer_id',
                'start_time',
                'end_time',
                'status',
            ])
            ->orderBy('computer_id')
            ->orderBy('start_time')
            ->get();

        return response()->json($bookings);
    }
}
