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

    public function show(Booking $booking)
    {
        return $booking;
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->all());
        return $booking;
    }

    public function destroy(Booking $booking)
    {
        return $booking->delete();
    }

    public function getOrderedDatesFromComputerIdAndDay($computer_id, $day)
    {
        try {
            $date = Carbon::parse($day)->startOfDay();
        } catch (Exception) {
            return response()->json(['error' => 'Неверный формат даты. Используй формат YYYY-MM-DD.'], 400);
        }

        $bookings = Booking::where('computer_id', $computer_id)
            ->whereDate('start_time', '<=', $date->copy()->endOfDay())
            ->whereDate('end_time', '>=', $date)
            ->select('id', 'start_time', 'end_time', 'status')
            ->get();

        return $bookings;
    }

    public function getFullInfo($id)
    {
        $booking = Booking::with([
            'computer.position.room.club'
        ])->find($id);

        if (!$booking) {
            return response()->json(['error' => 'Бронирование не найдено'], 404);
        }

        $club = $booking->computer->position->club ?? null;
        $room = $booking->computer->position->room ?? null;

        return response()->json([
            'id' => $booking->id,
            'user_id' => $booking->user_id,
            'computer_id' => $booking->computer_id,
            'start_time' => $booking->start_time,
            'end_time' => $booking->end_time,
            'total_price' => $booking->total_price,
            'status' => $booking->status,
            'club' => $club ? [
                'address' => $club->address,
                'phone' => $club->phone,
            ] : null,
            'room' => $room ? [
                'name' => $room->name,
            ] : null,
        ]);
    }
}
