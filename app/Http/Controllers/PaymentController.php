<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::all();
    }

    public function store(StorePaymentRequest $request)
    {
        return Payment::create($request->all());
    }

    public function show(Payment $id)
    {
        return $id;
    }

    public function update(UpdatePaymentRequest $request, Payment $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(Payment $id)
    {
        return $id->delete();
    }

    public function getByUserId($user_id, Request $request)
    {
        $authUser = $request->auth_user;

        if ($authUser->id !== (int)$user_id) {
            return response()->json(['message' => 'Access denied. Not your ids.'], 403);
        }

        return Payment::where('user_id', $authUser->id)->get();
    }
}
