<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingTariffRequest;
use App\Http\Requests\UpdateBookingTariffRequest;
use App\Models\BookingTariff;

class BookingTariffController extends Controller
{
    public function index()
    {
        return BookingTariff::all();
    }

    public function store(StoreBookingTariffRequest $request)
    {
        return BookingTariff::create($request->all());
    }

    public function show(BookingTariff $bookingTariff)
    {
        return $bookingTariff;
    }

    public function update(UpdateBookingTariffRequest $request, BookingTariff $bookingTariff)
    {
        $bookingTariff->update($request->all());
        return $bookingTariff;
    }

    public function destroy(BookingTariff $bookingTariff)
    {
        return $bookingTariff->delete();
    }
}
