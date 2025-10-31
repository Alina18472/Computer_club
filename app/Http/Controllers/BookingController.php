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
}
